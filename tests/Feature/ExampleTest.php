<?php

declare(strict_types=1);

use Andaniel05\LaravelFlows\LaravelFlows;

it('resolves the singleton', function () {
    expect(app(LaravelFlows::class))->toBeInstanceOf(LaravelFlows::class);
});

it('returns the same instance from the container', function () {
    expect(app(LaravelFlows::class))->toBe(app(LaravelFlows::class));
});

it('merges the package config', function () {
    expect(config('laravel-flows.placeholder'))->toBe('default');
});

it('loads the package translations', function () {
    expect(trans('laravel-flows::messages.placeholder'))->toBe('LaravelFlows placeholder translation.');
});

it('loads the package views', function () {
    expect(view()->exists('laravel-flows::placeholder'))->toBeTrue();
});

it('registers the artisan command', function () {
    $this->artisan('laravel-flows:placeholder')
        ->expectsOutputToContain('LaravelFlows placeholder command executed.')
        ->assertSuccessful();
});
