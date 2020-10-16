<?php

namespace iksaku\Laravel\Mops\Console;

use iksaku\Laravel\Mops\Util;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'mops:install
                            {--upgrade-mix : Automatically update Laravel Mix to v6}';

    protected $description = 'Install My Opinionated Scaffolding';

    public function handle()
    {
        putenv('INSTALLING_MOPS=true');

        $this->prepareMops();

        $this->configureFortify();
        $this->configureSessionDriver();
        $this->configureTallStack();

        $this->info('MOPS has been configured in your application. Happy coding!');
    }

    protected function prepareMops()
    {
        $this->comment('[Chores] Preparing mops for cleanup...');

        // Replace '/home' route with '/dashboard'.
        Util::replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Replace 'Home' references to 'Dashboard'.
        Util::replaceInFile(['/home', 'Home'], ['/dashboard', 'Dashboard'], resource_path('views/welcome.blade.php'));

        // Remove unnecessary style references
        (new Filesystem())->delete(resource_path('css/app.css'));
        (new Filesystem())->deleteDirectory(resource_path('sass'));

        $this->comment('[Chores] Cleanup is done, let\'s start with the fun stuff...');
    }

    protected function configureFortify(): void
    {
        $this->comment('[Fortify] Starting Configuration...', OutputInterface::VERBOSITY_DEBUG);

        // Publish Fortify Configuration.
        $this->comment('[Fortify] Publishing configuration...', OutputInterface::VERBOSITY_DEBUG);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-support', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-migrations', '--force' => true]);

        // Install Fortify Service Provider.
        $this->comment('[Fortify] Configuring FortifyServiceProvider', OutputInterface::VERBOSITY_DEBUG);
        Util::replaceInFile(
            'App\Providers\FortifyServiceProvider::class',
            'App\Providers\RouteServiceProvider::class,'.PHP_EOL.'        App\Providers\FortifyServiceProvider::class,',
            config_path('app.php'),
            fn ($search, $file_contents) => !Str::contains($file_contents, $search)
        );

        $this->info('[Fortify] Laravel Fortify has been configured.');
    }

    protected function configureSessionDriver()
    {
        $this->comment('[Drivers] Starting Configuration...', OutputInterface::VERBOSITY_DEBUG);

        $this->comment('[Drivers] Looking for migration table...', OutputInterface::VERBOSITY_DEBUG);
        if (! class_exists('CreateSessionsTable')) {
            try {
                $this->comment('[Drivers] Publishing migration table...', OutputInterface::VERBOSITY_DEBUG);
                $this->callSilent('session:table');
            } catch (Exception $e) {
                //
            }
        }

        // Use Database Session Driver (For Sanctum Compatibility)
        $this->comment('[Drivers] Configuring Session Driver...', OutputInterface::VERBOSITY_DEBUG);
        Util::replaceInFile("'SESSION_DRIVER', 'file'", "'SESSION_DRIVER', 'database'", config_path('session.php'));
        Util::replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env'));
        Util::replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env.example'));

        // Use Stateful Guard as general Middleware
        $this->comment('[Drivers] Configuring AuthenticateSession middleware...', OutputInterface::VERBOSITY_DEBUG);
        Util::replaceInFile(
            '// \Illuminate\Session\Middleware\AuthenticateSession::class',
            '\iksaku\Laravel\Mops\Http\Middleware\AuthenticateSession::class',
            app_path('Http/Kernel.php')
        );

        $this->info('[Drivers] Session Driver has been configured.');
    }

    protected function configureTallStack()
    {
        $this->comment('Entering the TALLStack land...', OutputInterface::VERBOSITY_DEBUG);

        $this->comment('[TALLStack] Part 1: Composer Packages...');

        // Install Livewire and Sanctum.
        $this->comment('[TALLStack] Installing composer packages', OutputInterface::VERBOSITY_DEBUG);
        (new Process(['composer', 'require', 'livewire/livewire:^2.3.0', 'laravel/sanctum:^2.6.0'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Publish Livewire Configuration.
        $this->comment('[TALLStack] Tweaking Livewire configuration...', OutputInterface::VERBOSITY_DEBUG);
        $this->callSilent('vendor:publish', ['--tag' => 'livewire:config', '--force' => true]);

        // Tweak Livewire Initial Configuration.
        Util::replaceInFile(
            ["'class_namespace' => 'App\\\\Http\\\\Livewire'", "'view_path' => resource_path('views/livewire')"],
            ["'class_namespace' => 'App\\\\Http\\\\Controllers'", "'view_path' => resource_path('views')"],
            config_path('livewire.php')
        );

        // Publish Sanctum Configuration.
        $this->comment('[TALLStack] Configuring Laravel Sanctum...', OutputInterface::VERBOSITY_DEBUG);
        $this->callSilent('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider', '--force' => true]);

        $this->comment('[TALLStack] Part 2: Node Packages...');

        // Install NPM packages.
        $this->comment('[TALLStack] Adding node packages...', OutputInterface::VERBOSITY_DEBUG);
        Util::updateNodePackages(function ($packages) {
            return array_merge(
                [
                    '@iksaku/tailwindcss-plugins' => '^2.0.1',
                    '@tailwindcss/ui' => '^0.6.0',
                    'alpinejs' => '^2.7.0',
                    'autoprefixer' => '^9.8.0',
                    'tailwindcss' => '^1.8.0',
                    'vue-template-compiler' => '^2.6.10'
                ],
                Arr::except(
                    $packages,
                    ['axios', 'lodash', 'resolve-url-loader']
                )
            );
        });

        // Determine if the opt-in Laravel Mix upgrade was also chosen.
        if ($this->option('upgrade-mix')) {
            $this->call('mops:upgrade-mix');
        }

        // Use Yarn instead of NPM
        $this->comment('[TALLStack] Replacing NPM with Yarn scripts...', OutputInterface::VERBOSITY_DEBUG);
        Util::replaceInFile(
            ['npm run', '-- --watch'],
            ['yarn', '--watch'],
            base_path('package.json')
        );

        // Install Yarn Packages
        $this->comment('[TALLStack] Installing node packages...', OutputInterface::VERBOSITY_DEBUG);
        (new Process(['yarn', 'install'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        $this->comment('[TALLStack] Part 3: MOPS Stubs...');

        // Copy Stubs to Application directory
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs', base_path());

        $this->info('TALLStack has been configured.');
    }
}