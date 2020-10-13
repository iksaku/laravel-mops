<?php

namespace iksaku\Laravel\Mops\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'mops:install';

    protected $description = 'Install My Opinionated Scaffolding';

    public function handle()
    {
        // Replace '/home' route with '/dashboard'.
        $this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Replace 'Home' references to 'Dashboard'.
        $this->replaceInFile(['/home', 'Home'], ['/dashboard', 'Dashboard'], resource_path('views/welcome.blade.php'));

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
        $this->replaceInFile(
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
        $this->replaceInFile("'SESSION_DRIVER', 'file'", "'SESSION_DRIVER', 'database'", config_path('session.php'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env.example'));

        // Use Stateful Guard as general Middleware
        $this->replaceInFile(
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
        $this->replaceInFile(
            ["'class_namespace' => 'App\\\\Http\\\\Livewire'", "'view_path' => resource_path('views/livewire')"],
            ["'class_namespace' => 'App\\\\Http\\\\Controllers'", "'view_path' => resource_path('views')"],
            config_path('livewire.php')
        );

        // Publish Sanctum Configuration.
        $this->call('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider', '--force' => true]);

        // Install NPM packages.
        $this->updateNodePackages(function ($packages) {
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

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Run str_replace in a File.
     *
     * @param string|string[] $search
     * @param string|string[] $replace
     * @param string $path
     * @param callable|null $condition
     */
    protected function replaceInFile($search, $replace, string $path, callable $condition = null)
    {
        // Don't replace anything, since the file doesn't exist.
        if (!file_exists($path)) {
            return;
        }

        $file_contents = file_get_contents($path);

        // Only execute if a condition is provided and passes.
        if (is_callable($condition) && !$condition($search, $file_contents)) {
            return;
        }

        file_put_contents($path, str_replace($search, $replace, $file_contents));
    }
}