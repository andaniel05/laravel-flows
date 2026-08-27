<?php

declare(strict_types=1);

namespace Andaniel05\LaravelFlows;

use Illuminate\Support\ServiceProvider;

class LaravelFlowsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FlowDispatcher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
