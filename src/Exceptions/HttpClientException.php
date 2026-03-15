<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use RuntimeException;
use Throwable;

class HttpClientException extends RuntimeException
{
    public function __construct(
        string $message = 'An error occurred while sending the request to the payment gateway',
        public readonly int $statusCode = 0,
        public readonly array $responseBody = [],
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function isUnauthorized(): bool
    {
        return $this->statusCode === 401;
    }

    public function isNotFound(): bool
    {
        return $this->statusCode === 404;
    }

    public function isValidationError(): bool
    {
        return $this->statusCode === 422;
    }

    public function isServerError(): bool
    {
        return $this->statusCode >= 500;
    }

    public function getGatewayMessage(): string
    {
        return $this->responseBody['message'] ?? $this->getMessage();
    }
}
