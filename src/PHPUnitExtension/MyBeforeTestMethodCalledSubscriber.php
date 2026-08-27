<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use Andaniel05\LaravelFlows\FlowDispatcher;
use PHPUnit\Event\Test\BeforeTestMethodCalled;
use PHPUnit\Event\Test\BeforeTestMethodCalledSubscriber;

final readonly class MyBeforeTestMethodCalledSubscriber implements BeforeTestMethodCalledSubscriber
{
    public function notify(BeforeTestMethodCalled $event): void
    {
        app()->singleton(FlowDispatcher::class, fn () => new FakeFlowDispatcher);

        FlowExpectation::$instances = [];
    }
}
