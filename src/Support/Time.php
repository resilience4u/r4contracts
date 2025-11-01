<?php
declare(strict_types=1);

namespace Resilience4u\R4Contracts\Support;

/**
 * Lightweight time utilities for precise measurement and timestamps.
 */
final class Time
{
    private function __construct() {}

    /**
     * Current time in milliseconds.
     */
    public static function nowMs(): int
    {
        return (int) floor(microtime(true) * 1000);
    }

    /**
     * Current time in seconds.
     */
    public static function nowSec(): int
    {
        return time();
    }

    /**
     * Elapsed milliseconds since a given start timestamp (ms).
     *
     * @param int $startMs Milliseconds timestamp to compare against (e.g., from nowMs()).
     * @return int Elapsed time in milliseconds (non-negative).
     */
    public static function elapsedMs(int $startMs): int
    {
        return max(0, self::nowMs() - $startMs);
    }

    /**
     * Measures a callable execution time in milliseconds.
     *
     * @template T
     * @param callable():T $callback
     * @return array{result:T, elapsedMs: float}
     */
    public static function measure(callable $callback): array
    {
        $start = microtime(true);
        $result = $callback();
        $elapsedMs = (microtime(true) - $start) * 1000.0;

        return ['result' => $result, 'elapsedMs' => $elapsedMs];
    }

    /**
     * Formats milliseconds into a human-friendly string.
     */
    public static function formatMs(float $ms): string
    {
        return $ms < 1000
            ? sprintf('%.2f ms', $ms)
            : sprintf('%.2f s', $ms / 1000);
    }
}
