<?php

namespace iksaku\Laravel\Mops\Console;

use iksaku\Laravel\Mops\Util;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'mops:install
                            {--upgrade-mix : Automatically update Laravel Mix to v6}';

    protected $description = 'Install My Opinionated Scaffolding';

    public function handle()
    {
        putenv('INSTALLING_MOPS=true');

        // Replace '/home' route with '/dashboard'.
        Util::replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Replace 'Home' references to 'Dashboard'.
        Util::replaceInFile(['/home', 'Home'], ['/dashboard', 'Dashboard'], resource_path('views/welcome.blade.php'));

        // Configure other things...
        $this->configureFortify();
        $this->configureSessionDriver();
        $this->configureTallStack();
    }

    protected function configureFortify(): void
    {
        // Publish Fortify Configuration.
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-support', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-migrations', '--force' => true]);

        // Install Fortify Service Provider.
        Util::replaceInFile(
            'App\Providers\FortifyServiceProvider::class',
            'App\Providers\RouteServiceProvider::class,'.PHP_EOL.'        App\Providers\FortifyServiceProvider::class,',
            config_path('app.php'),
            fn ($search, $file_contents) => !Str::contains($file_contents, $search)
        );
    }

    protected function configureSessionDriver()
    {
        if (! class_exists('CreateSessionsTable')) {
            try {
                $this->call('session:table');
            } catch (Exception $e) {
                //
            }
        }

        // Use Database Session Driver (For Sanctum Compatibility)
        Util::replaceInFile("'SESSION_DRIVER', 'file'", "'SESSION_DRIVER', 'database'", config_path('session.php'));
        Util::replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env'));
        Util::replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env.example'));

        // Use Stateful Guard as general Middleware
        Util::replaceInFile(
            '// \Illuminate\Session\Middleware\AuthenticateSession::class',
            '\iksaku\Laravel\Mops\Http\Middleware\AuthenticateSession::class',
            app_path('Http/Kernel.php')
        );
    }

    protected function configureTallStack()
    {
        // Install Livewire and Sanctum.
        (new Process(['composer', 'require', 'livewire/livewire:^2.3', 'laravel/sanctum:^2.6'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // Publish Livewire Configuration.
        $this->call('vendor:publish', ['--tag' => 'livewire:config', '--force' => true]);

        // Tweak Livewire Initial Configuration.
        Util::replaceInFile(
            ["'class_namespace' => 'App\\\\Http\\\\Livewire'", "'view_path' => resource_path('views/livewire')"],
            ["'class_namespace' => 'App\\\\Http\\\\Controllers'", "'view_path' => resource_path('views')"],
            config_path('livewire.php')
        );

        // Publish Sanctum Configuration.
        $this->call('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider', '--force' => true]);

        // Install NPM packages.
        Util::updateNodePackages(function ($packages) {
            return array_merge(
                [
                    '@iksaku/tailwindcss-plugins' => '^2.0.1',
                    '@tailwindcss/ui' => '^0.6.0',
                    'alpinejs' => '^2.7.0',
                    'autoprefixer' => '^10.0.0',
                    'tailwindcss' => '^1.8.0'
                ],
                Arr::except(
                    $packages,
                    ['axios', 'lodash', 'resolve-url-loader']
                )
            );
        });

        // Determine if the opt-in Laravel Mix upgrade was also chosen.
        if ($this->hasOption('upgrade-mix')) {
            $this->callSilent('mops:upgrade-mix');
        }

        // Use Yarn instead of NPM
        $this->replaceInFile(
            ['npm run', '-- --watch'],
            ['yarn', '--watch'],
            base_path('package.json')
        );

        // Install Yarn Packages
        (new Process(['yarn', 'install'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        (new Filesystem())->deleteDirectory(resource_path('sass'));

        // Copy Stubs to Application directory
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs', base_path());
    }
}