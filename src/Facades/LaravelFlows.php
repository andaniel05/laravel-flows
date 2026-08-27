<?php

declare(strict_types=1);

namespace Andaniel05\LaravelFlows\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Andaniel05\LaravelFlows\LaravelFlows
 */
class LaravelFlows extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Andaniel05\LaravelFlows\LaravelFlows::class;
    }
}
