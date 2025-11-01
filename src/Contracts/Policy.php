<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Defines the core behavior of a resilience policy (e.g. Retry, CircuitBreaker, RateLimiter).
 */
interface Policy
{
    /**
     * Returns the unique name of this policy.
     */
    public function name(): string;

    /**
     * Executes the given operation under this policy.
     *
     * @template T
     * @param Executable $op The operation to execute.
     * @return mixed The operation result.
     * @throws \Throwable If execution fails or policy denies execution.
     */
    public function execute(Executable $op): mixed;
}
