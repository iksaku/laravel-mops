<?php

namespace iksaku\Laravel\Mops;

use Illuminate\Support\ServiceProvider;

class MopsServiceProvider extends ServiceProvider
{
    /*
     * Register my opinionated services.
     */
    public function register(): void
    {

    }

    /*
     * Bootstrap my opinionated services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mops');

        // Blade::componentNamespace('iksaku\Laravel\Mops\Components', 'mops');
        
        $this->registerCommands();

        $this->publishes([
            // __DIR__.'/View/Components' => app_path('View/Components'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/mops')
        ], 'mops-components');
    }

    public function registerCommands()
    {
        if (!$this->app->runningInConsole()) return;

        $this->commands([
            Console\InstallCommand::class
        ]);
    }
}