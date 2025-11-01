<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Represents an executable operation that can be wrapped by a resilience policy.
 */
interface Executable
{
    /**
     * Invokes the wrapped operation.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function __invoke(): mixed;
}
