<?php

namespace Andaniel05\LaravelFlows;

use Andaniel05\Flows\AbstractFlow;

class FlowDispatcher
{
    /** @var array<AbstractFlow> */
    public array $dispatchedFlows = [];

    public function dispatch(AbstractFlow $flow)
    {
        $this->dispatchedFlows[] = $flow;

        return $flow->execute();
    }
}
