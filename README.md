# 🧩 R4Contracts

> **Shared contracts and support utilities for the [Resilience4u](https://github.com/resilience4u) ecosystem.**

`R4Contracts` defines the common interfaces, types, and lightweight helpers used across all **Resilience4u** libraries — such as [`R4PHP`](https://github.com/resilience4u/r4php), [`R4Go`](https://github.com/resilience4u/r4go), and [`R4PolicyEngine`](https://github.com/resilience4u/r4policy-engine).

It provides the shared foundation for building **consistent, interoperable resilience libraries** — without introducing heavy dependencies.

---

## 📦 Installation

```bash
composer require resilience4u/r4contracts
```

---

## 🧱 Structure

```
src/
├── Contracts/
│   ├── Policy.php
│   ├── Executable.php
│   ├── StorageAdapter.php
│   └── TelemetryAdapter.php
└── Support/
    ├── Time.php
    └── Env.php
```

---

## 🚀 Purpose

| Area | Description |
|------|--------------|
| **Contracts** | Define core interfaces that describe resilience primitives (CircuitBreaker, Retry, etc.) |
| **Support** | Provide minimal helper utilities (`Time`, `Env`) shared across multiple libraries |
| **Telemetry** | Offer a contract (`TelemetryAdapter`) for optional distributed tracing and metrics — without coupling to OpenTelemetry or any exporter |

---

## 🧠 Design Principles

- 🪶 **Zero dependencies** — pure PHP, no vendor lock-in  
- 🔄 **Bidirectional reusability** — can be used by *R4PHP*, *R4Go*, *R4JS*, or any language bridge  
- 🧩 **Stable contracts** — consistent method signatures across the ecosystem  
- ⚙️ **Opt-in telemetry** — instrumentation only when explicitly enabled by environment or adapter  
- 💡 **Extensible by design** — supports third-party exporters, storage adapters, and policies

---

## 🧩 Key Interfaces

### `Contracts\Policy`

Base interface for all resilience patterns:
```php
interface Policy
{
    public function name(): string;
    public function execute(Executable $op): mixed;
}
```

### `Contracts\Executable`

Encapsulates an operation that can be retried, rate-limited, or executed under a circuit breaker:
```php
interface Executable
{
    public function __invoke(): mixed;
}
```

### `Contracts\StorageAdapter`

Abstracts how policies persist transient state (in-memory, APCu, Redis, etc.):
```php
interface StorageAdapter
{
    public function get(string $key, mixed $default = null): mixed;
    public function set(string $key, mixed $value, int $ttl = 0): void;
    public function delete(string $key): void;
}
```

### `Contracts\TelemetryAdapter`

Optional bridge for distributed tracing and metrics:
```php
interface TelemetryAdapter
{
    public function record(string $policy, string $event, array $context = []): void;
}
```

---

## 🧰 Support Utilities

### `Support\Time`

Lightweight microtime helper:
```php
Time::nowMs(); // current timestamp in milliseconds
Time::elapsedMs($start); // measure elapsed time
```

### `Support\Env`

Simple environment utility:
```php
Env::bool('R4PHP_TELEMETRY_ENABLED', false); // returns true/false
Env::int('R4PHP_MAX_RETRIES', 3);
```

---

## 🧭 Ecosystem

| Library | Role |
|----------|------|
| [**R4Contracts**](https://github.com/resilience4u/r4contracts) | Shared contracts & utilities |
| [**R4PHP**](https://github.com/resilience4u/r4php) | Resilience primitives for PHP (retry, circuit breaker, etc.) |
| [**R4PolicyEngine**](https://github.com/resilience4u/r4policy-engine) | Policy orchestration & telemetry engine |
| [**R4Go**](https://github.com/resilience4u/r4go) | Go runtime equivalent of R4PHP |
| [**Faceless Logger**](https://github.com/resilience4u/faceless-logger) | LGPD-first log anonymization pipeline |

---

## 🧬 Example Integration

```php
use Resilience4u\R4Contracts\Contracts\TelemetryAdapter;

class CustomTelemetry implements TelemetryAdapter
{
    public function record(string $policy, string $event, array $context = []): void
    {
        printf("[telemetry] %s - %s (%s)\n", $policy, $event, json_encode($context));
    }
}
```

---

## 📜 License

MIT © [Resilience4u](https://github.com/resilience4u)

---

## 💬 Community

Join our discussions on Slack:  
[![Join Slack](https://img.shields.io/badge/slack-join-blue?logo=slack)](https://join.slack.com/t/resilience4u/shared_invite/zt-3guwse4dz-a5WGvtQeLouHVzZFW9KKEw)
