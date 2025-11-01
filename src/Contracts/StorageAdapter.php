<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

/**
 * Abstraction for persistence of transient policy state (e.g. CircuitBreaker counters, cache, etc.).
 */
interface StorageAdapter
{
    /**
     * Fetches a value from storage.
     *
     * @param string $key The key to retrieve.
     * @param mixed $default Default value if key is missing.
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Stores a value with an optional TTL (in seconds).
     *
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time to live (0 = infinite).
     */
    public function set(string $key, mixed $value, int $ttl = 0): void;

    /**
     * Deletes a key from storage.
     */
    public function delete(string $key): void;
}
