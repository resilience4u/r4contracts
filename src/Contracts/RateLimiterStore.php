<?php declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Interface RateLimiterStore
 *
 * Defines a minimal contract for persisting rate limiter state.
 * Concrete implementations may use in-memory arrays, Redis, databases, etc.
 *
 * Each stored entry should maintain at least:
 *   - available tokens
 *   - last refill timestamp
 *   - optional metadata for control or metrics
 *
 * The internal structure of the state array is intentionally generic,
 * as long as it is serializable and contains the required fields.
 */
interface RateLimiterStore
{
    /**
     * Retrieves the current state of the rate limiter for a given identifier.
     *
     * @param string $id Unique identifier of the limiter (e.g., "user:123")
     * @return array<string, mixed>|null The stored state, or null if not found
     */
    public function get(string $id): ?array;

    /**
     * Persists or updates the state of the rate limiter.
     *
     * @param string $id Unique identifier of the limiter
     * @param array<string, mixed> $state Structure containing tokens, timestamps, etc.
     * @return void
     */
    public function set(string $id, array $state): void;

    /**
     * Removes the stored state of a limiter (used for resets or cleanup).
     *
     * @param string $id Unique identifier of the limiter
     * @return void
     */
    public function delete(string $id): void;
}
