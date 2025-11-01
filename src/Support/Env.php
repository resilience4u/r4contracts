<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Support;

/**
 * Small helper for environment variable access with type coercion and defaults.
 *
 * Avoids relying directly on getenv() or $_ENV throughout the codebase.
 */
final class Env
{
    private function __construct() {}

    /**
     * Reads an environment variable with an optional default.
     *
     * @param string $key
     * @param mixed $default
     * @return string|int|float|bool|null
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? getenv($key);

        if ($value === false || $value === null) {
            return $default;
        }

        $trimmed = trim((string) $value);

        // Automatic type coercion
        if (is_numeric($trimmed) && !str_contains($trimmed, '.')) {
            return (int) $trimmed;
        }

        if (is_numeric($trimmed) && str_contains($trimmed, '.')) {
            return (float) $trimmed;
        }

        $lower = strtolower($trimmed);
        return match ($lower) {
            'true', '(true)', '1'  => true,
            'false', '(false)', '0' => false,
            'null', '(null)' => null,
            default => $trimmed,
        };
    }

    /**
     * Reads a boolean environment flag safely.
     */
    public static function bool(string $key, bool $default = false): bool
    {
        return (bool) self::get($key, $default);
    }

    /**
     * Reads an integer environment variable safely.
     */
    public static function int(string $key, int $default = 0): int
    {
        return (int) self::get($key, $default);
    }

    /**
     * Reads a float environment variable safely.
     */
    public static function float(string $key, float $default = 0.0): float
    {
        return (float) self::get($key, $default);
    }

    /**
     * Reads a string environment variable safely.
     */
    public static function string(string $key, string $default = ''): string
    {
        $v = self::get($key, $default);
        return is_string($v) ? $v : (string) $v;
    }
}
