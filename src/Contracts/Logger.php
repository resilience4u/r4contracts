<?php declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Lightweight structured logging contract for all R4 components.
 *
 * Implementations may delegate to PSR-3, Monolog, or custom sinks.
 */
interface Logger
{
    /**
     * Logs a debug-level message.
     *
     * @param string $message
     * @param array<string, mixed> $context
     */
    public function debug(string $message, array $context = []): void;

    /**
     * Logs an informational message.
     */
    public function info(string $message, array $context = []): void;

    /**
     * Logs a warning message, used for resilience triggers (e.g., rate limit exceeded).
     */
    public function warning(string $message, array $context = []): void;

    /**
     * Logs an error message, used for unexpected failures.
     */
    public function error(string $message, array $context = []): void;
}
