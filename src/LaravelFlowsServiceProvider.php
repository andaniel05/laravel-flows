<?php

declare(strict_types=1);

namespace Andaniel05\LaravelFlows;

use Andaniel05\LaravelFlows\Console\Commands\LaravelFlowsCommand;
use Illuminate\Support\ServiceProvider;

class LaravelFlowsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-flows.php', 'laravel-flows');

        $this->app->singleton(LaravelFlows::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/laravel-flows.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-flows');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-flows');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/laravel-flows.php' => config_path('laravel-flows.php'),
        ], ['laravel-flows', 'laravel-flows-config']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-flows'),
        ], ['laravel-flows', 'laravel-flows-views']);

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-flows'),
        ], ['laravel-flows', 'laravel-flows-lang']);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/laravel-flows'),
        ], ['laravel-flows', 'laravel-flows-assets']);

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['laravel-flows', 'laravel-flows-migrations']);

        $this->commands([
            LaravelFlowsCommand::class,
        ]);
    }
}
