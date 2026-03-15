<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Data;

readonly class PaymentResponse
{
    public function __construct(
        public bool $successful,
        public string $message,
        public array $data = [],
    ) {}

    public static function fromArray(array $raw): self
    {
        $status = $raw['status'] ?? false;

        return new self(
            successful: $status === true || $status === 'success',
            message: $raw['message'] ?? '',
            data: $raw['data'] ?? $raw,
        );
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function failed(): bool
    {
        return ! $this->successful;
    }
}
