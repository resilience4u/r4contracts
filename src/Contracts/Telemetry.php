<?php declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Telemetry contract for emitting metrics, traces, and logs across R4 ecosystem.
 *
 * Implementations (e.g., R4Telemetry) can bridge to Prometheus, OpenTelemetry,
 * or custom exporters. This interface provides a minimal, provider-agnostic contract.
 */
interface Telemetry
{
    /**
     * Starts a new telemetry span.
     *
     * @param string $name The span name (e.g., 'r4php.retry', 'r4feature.evaluation')
     * @param array<string, mixed> $attributes Key-value attributes attached to the span
     * @return mixed A span handle or context token, implementation-defined
     */
    public function startSpan(string $name, array $attributes = []): mixed;

    /**
     * Ends a telemetry span, optionally adding final attributes (e.g., status, error).
     *
     * @param mixed $span The span handle returned from startSpan()
     * @param array<string, mixed> $attributes Additional attributes to record
     */
    public function endSpan(mixed $span, array $attributes = []): void;

    /**
     * Records a metric datapoint.
     *
     * @param string $name Metric name (e.g., 'r4php_retry_attempts_total')
     * @param float|int $value The metric value
     * @param array<string, string|int|float> $labels Optional key-value labels/tags
     */
    public function addMetric(string $name, float|int $value, array $labels = []): void;

    /**
     * Records a single event within an ongoing span.
     *
     * @param string $eventName Descriptive event name
     * @param array<string, mixed> $attributes Optional contextual attributes
     */
    public function addEvent(string $eventName, array $attributes = []): void;
}
