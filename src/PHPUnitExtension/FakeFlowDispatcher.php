<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use Andaniel05\Flows\AbstractFlow;
use App\FlowDispatcher;

class FakeFlowDispatcher extends FlowDispatcher
{
    public function dispatch(AbstractFlow $flow)
    {
        $flowClass = get_class($flow);

        foreach (FlowExpectation::$instances as $flowExpectation) {
            if ($flowClass === $flowExpectation->flowClass
                && $flowExpectation->editAfterClosure
            ) {
                $this->dispatchedFlows[] = $flow;

                return call_user_func($flowExpectation->editAfterClosure, $flow);
            }
        }

        return parent::dispatch($flow);
    }
}
