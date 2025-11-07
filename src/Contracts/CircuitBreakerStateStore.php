<?php declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Interface CircuitBreakerStateStore
 *
 * Defines a contract for persisting circuit breaker state across executions.
 * Implementations can use in-memory, Redis, databases, or distributed caches.
 *
 * Each stored entry should include at least:
 *   - current state (closed / open / half_open)
 *   - timestamps (openedAt, lastFailure, etc.)
 *   - statistical counters (success/failure history)
 *
 * The internal structure of the state array is intentionally generic
 * to allow flexible and distributed storage.
 */
interface CircuitBreakerStateStore
{
    /**
     * Retrieves the stored circuit breaker state for the given identifier.
     *
     * @param string $id Unique identifier of the circuit breaker (e.g., "payment-service")
     * @return array<string, mixed>|null The stored state or null if none exists
     */
    public function get(string $id): ?array;

    /**
     * Persists or updates the circuit breaker state.
     *
     * @param string $id Unique identifier of the circuit breaker
     * @param array<string, mixed> $state Serialized state information
     * @return void
     */
    public function set(string $id, array $state): void;

    /**
     * Deletes or resets the circuit breaker state.
     *
     * @param string $id Unique identifier of the circuit breaker
     * @return void
     */
    public function delete(string $id): void;
}
