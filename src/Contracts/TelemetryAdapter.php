<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Optional hook interface for telemetry integration (tracing, metrics, logs).
 *
 * Implementations can send data to OpenTelemetry, Prometheus, StatsD, etc.
 */
interface TelemetryAdapter
{
    /**
     * Records a telemetry event related to a resilience policy.
     *
     * @param string $policy  The policy name (e.g. "circuitBreaker:http").
     * @param string $event   The event type (e.g. "success", "failure", "opened").
     * @param array<string,mixed> $context  Additional contextual info.
     */
    public function record(string $policy, string $event, array $context = []): void;
}
