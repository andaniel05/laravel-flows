<?php

use Andaniel05\Flows\AbstractFlow;
use Andaniel05\Flows\Execution;
use App\FlowDispatcher;

function flow(AbstractFlow $flow): Execution
{
    $flowDispatcher = app(FlowDispatcher::class);

    return $flowDispatcher->dispatch($flow);
}
