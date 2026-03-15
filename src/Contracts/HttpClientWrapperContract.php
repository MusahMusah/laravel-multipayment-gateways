<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface HttpClientWrapperContract
{
    /**
     * Send a GET request to the payment gateway
     */
    public function get(string $url, array $query = [], array $headers = []): array;

    /**
     * Send a POST request to the payment gateway
     */
    public function post(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array;

    /**
     * Send a PUT request to the payment gateway
     */
    public function put(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array;

    /**
     * Send a PATCH request to the payment gateway
     */
    public function patch(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array;

    /**
     * Send a DELETE request to the payment gateway
     */
    public function delete(string $url, array $data = [], array $query = [], array $headers = []): array;
}
