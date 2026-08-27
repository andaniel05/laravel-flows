<?php

use Andaniel05\LaravelFlows\PHPUnitExtension\ApplicationStartedSubscriber;
use Andaniel05\LaravelFlows\PHPUnitExtension\FlowExpectation;

function expectFlow(string $flowClass): FlowExpectation
{
    $flowExpectation = new FlowExpectation($flowClass);

    FlowExpectation::$instances[] = $flowExpectation;

    return $flowExpectation;
}

function expectFlowBranches(array $expectations): void
{
    $flowClasses = ApplicationStartedSubscriber::$flowClasses;
    $flowClassesWithExpectations = [];

    foreach ($expectations as $flowClass => $expectedFlowBranches) {
        test("check flow branches for '$flowClass'", function () use ($flowClass, $expectedFlowBranches) {
            if (! in_array($flowClass, ApplicationStartedSubscriber::$flowClasses)) {
                throw new Exception("The class '$flowClass' is not a flow.");
            }

            $flowBranches = call_user_func([$flowClass, 'getBranches']);

            expect($flowBranches)->toBe($expectedFlowBranches);

            ApplicationStartedSubscriber::$verifiedFlowClasses[] = $flowClass;
        });

        $flowClassesWithExpectations[] = $flowClass;
    }

    $diff = array_diff($flowClasses, $flowClassesWithExpectations);

    if (! empty($diff)) {
        throw new Exception('There are flow classes without branch expectations: '.print_r(array_values($diff), true));
    }
}
