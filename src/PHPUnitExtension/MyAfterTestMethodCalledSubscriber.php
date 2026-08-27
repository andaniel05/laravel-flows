<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use PHPUnit\Event\Test\AfterTestMethodCalled;
use PHPUnit\Event\Test\AfterTestMethodCalledSubscriber;

final readonly class MyAfterTestMethodCalledSubscriber implements AfterTestMethodCalledSubscriber
{
    public function notify(AfterTestMethodCalled $event): void
    {
        foreach (FlowExpectation::$instances as $flowExpectation) {
            $flowExpectation->verify();
        }
    }
}
