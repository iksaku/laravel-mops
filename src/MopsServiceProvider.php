<?php

namespace iksaku\Laravel\Mops;

use Illuminate\Support\Facades\Blade;
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
        $this->configureComponents();
        $this->configureLocalization();
        $this->registerCommands();
    }

    public function configureComponents()
    {
        Blade::componentNamespace('iksaku\Laravel\Mops\Components', 'mops');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mops');

        $this->publishes([
            // TODO: Research the possibility to override Component Classes
            // __DIR__.'/View/Components' => app_path('View/Components'),

            __DIR__.'/../resources/views' => resource_path('views/vendor/mops')
        ], 'mops-components');
    }

    public function configureLocalization()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mops');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/mops')
        ], 'mops-localization');
    }

    public function registerCommands()
    {
        if (!$this->app->runningInConsole()) return;

        $this->commands([
            Console\InstallCommand::class,
            Console\UpgradeLaravelMixCommand::class
        ]);
    }
}