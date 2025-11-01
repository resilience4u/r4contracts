<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Contracts;

interface StorageAdapter
{
    /**
     * Retrieves a value.
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Sets a value with an optional TTL.
     */
    public function set(string $key, mixed $value, ?int $ttl = null): bool;

    /**
     * Deletes a key.
     */
    public function delete(string $key): bool;

    /**
     * Atomically increments a numeric value.
     * Creates the key if it does not exist.
     */
    public function increment(string $key, int $by = 1, ?int $ttl = null): int;

    /**
     * Retrieves multiple values at once.
     */
    public function getMultiple(array $keys): array;
}