<?php

namespace iksaku\Laravel\Mops;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class MopsServiceProvider extends ServiceProvider
{
    /*
     * Register my opinionated services.
     */
    public function register(): void
    {
        Blade::if('route', 'in_route');
    }

    /*
     * Bootstrap my opinionated services.
     */
    public function boot(): void
    {
        $this->configureComponents();
        $this->configureFortifyViews();
        $this->configureLocalization();
        $this->registerCommands();
    }

    public function configureComponents(): void
    {
        Blade::componentNamespace('iksaku\Laravel\Mops\View\Components', 'mops');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mops');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/mops')
            ], 'mops-components');
        }
    }

    public function configureFortifyViews(): void
    {
        // Auth Views
        Fortify::loginView('auth.login');
        Fortify::twoFactorChallengeView('auth.2fa-challenge');
        Fortify::registerView('auth.register');

        // Password Views
        Fortify::requestPasswordResetLinkView('auth.password.forgot');
        Fortify::resetPasswordView('auth.password.reset');
        Fortify::confirmPasswordView('auth.password.confirm');

        // Email Views
        Fortify::verifyEmailView('auth.email.verify');
    }

    public function configureLocalization(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mops');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/mops')
            ], 'mops-localization');
        }
    }

    public function registerCommands(): void
    {
        if (!$this->app->runningInConsole()) return;

        $this->commands([
            Console\InstallCommand::class,
            Console\UpgradeLaravelMixCommand::class
        ]);
    }
}