<?php

declare(strict_types=1);

namespace Andaniel05\LaravelFlows\Console\Commands;

use Illuminate\Console\Command;

class LaravelFlowsCommand extends Command
{
    /**
     * The command signature.
     */
    protected $signature = 'laravel-flows:placeholder';

    /**
     * The command description.
     */
    protected $description = 'Placeholder Artisan command shipped by the package laravel-flows.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->line('LaravelFlows placeholder command executed.');

        return self::SUCCESS;
    }
}
