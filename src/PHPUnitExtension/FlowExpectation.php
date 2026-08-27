<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use App\FlowDispatcher;

class FlowExpectation
{
    public static array $instances = [];

    public string $expectedBranchName = 'Default';

    public ?\Closure $validationClosure = null;

    public ?\Closure $editAfterClosure = null;

    public function __construct(public string $flowClass) {}

    public function onBranch(string $branchName): self
    {
        $this->expectedBranchName = $branchName;

        return $this;
    }

    public function with(\Closure $validationClosure): self
    {
        $this->validationClosure = $validationClosure;

        return $this;
    }

    public function after(\Closure $editAfterClosure): self
    {
        $this->editAfterClosure = $editAfterClosure;

        return $this;
    }

    public function verify(): void
    {
        $flowDispatcher = app(FlowDispatcher::class);

        foreach ($flowDispatcher->dispatchedFlows as $dispatchedFlow) {
            if (get_class($dispatchedFlow) !== $this->flowClass) {
                continue;
            }

            if ($this->expectedBranchName !== $dispatchedFlow->getCurrentBranchName()) {
                throw new \Exception(
                    "Dispatched branch({$dispatchedFlow->getCurrentBranchName()}) don't match with the expected({$this->expectedBranchName})."
                );
            }

            if (is_callable($this->validationClosure)) {
                $isValid = call_user_func($this->validationClosure, $dispatchedFlow);

                if (! $isValid) {
                    throw new \Exception('Error validating flow.');
                }
            }

            return;
        }

        throw new \Exception("No dispatched flow '{$this->flowClass}'.");
    }
}
