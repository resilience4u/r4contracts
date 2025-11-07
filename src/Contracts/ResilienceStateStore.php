<?php declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Unified state store for all resilience patterns (RateLimiter, CircuitBreaker, etc.).
 *
 * Each pattern uses a unique namespace and key to isolate its state.
 * Implementations may store data in memory, Redis, SQL, etc.
 */
interface ResilienceStateStore
{
    /**
     * Retrieve a stored state object for a given namespace/key pair.
     *
     * @param string $namespace Pattern type (e.g., "rateLimiter", "circuitBreaker").
     * @param string $key Unique identifier for the policy instance.
     * @return array<string,mixed>|null
     */
    public function get(string $namespace, string $key): ?array;

    /**
     * Persist or update a state object.
     *
     * @param string $namespace Pattern type.
     * @param string $key Unique identifier.
     * @param array<string,mixed> $state State payload.
     */
    public function set(string $namespace, string $key, array $state): void;

    /**
     * Remove a specific state key.
     *
     * @param string $namespace Pattern type.
     * @param string $key Unique identifier.
     */
    public function delete(string $namespace, string $key): void;
}
