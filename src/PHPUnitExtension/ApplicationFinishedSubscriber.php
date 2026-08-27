<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Application\FinishedSubscriber;

final readonly class ApplicationFinishedSubscriber implements FinishedSubscriber
{
    public function notify(Finished $event): void
    {
        $flowClasses = ApplicationStartedSubscriber::$flowClasses;
        $verifiedFlowClasses = ApplicationStartedSubscriber::$verifiedFlowClasses;

        $diff = array_diff($flowClasses, $verifiedFlowClasses);

        if (! empty($diff)) {
            throw new \Exception('There are flow classes without branch expectations: '.print_r(array_values($diff), true));
        }
    }
}
