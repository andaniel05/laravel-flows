<?php

use Andaniel05\Flows\AbstractFlow;
use Andaniel05\Flows\Execution;
use Andaniel05\LaravelFlows\FlowDispatcher;

function flow(AbstractFlow $flow): Execution
{
    $flowDispatcher = app(FlowDispatcher::class);

    return $flowDispatcher->dispatch($flow);
}
