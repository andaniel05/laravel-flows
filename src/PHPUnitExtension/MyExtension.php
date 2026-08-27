<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use PHPUnit\Runner\Extension\Extension as ExtensionInterface;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class MyExtension implements ExtensionInterface
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $facade->registerSubscribers(
            new ApplicationStartedSubscriber,
            new MyBeforeTestMethodCalledSubscriber,
            new MyAfterTestMethodCalledSubscriber,
            new ApplicationFinishedSubscriber,
        );
    }
}
