<?php

namespace Andaniel05\LaravelFlows;

use Andaniel05\LaravelFlows\PHPUnitExtension\ApplicationFinishedSubscriber;
use Andaniel05\LaravelFlows\PHPUnitExtension\ApplicationStartedSubscriber;
use Andaniel05\LaravelFlows\PHPUnitExtension\MyAfterTestMethodCalledSubscriber;
use Andaniel05\LaravelFlows\PHPUnitExtension\MyBeforeTestMethodCalledSubscriber;
use PHPUnit\Runner\Extension\Extension as ExtensionInterface;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

require_once __DIR__ . '/PHPUnitExtension/functions-for-testing.php';

final class PHPUnitExtension implements ExtensionInterface
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
