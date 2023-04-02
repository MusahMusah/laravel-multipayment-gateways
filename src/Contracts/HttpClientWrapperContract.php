<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface HttpClientWrapperContract
{
    /**
     * Send a GET request to the payment gateway
     */
    public function get(string $url, array $query = [], array $headers = []): mixed;

    /**
     * Send a POST request to the payment gateway
     */
    public function post(string $url, array $formParams = [], array $query = [], array $headers = []): mixed;

    /**
     * Send a PUT request to the payment gateway
     */
    public function put(string $url, array $formParams = [], array $query = [], array $headers = []): mixed;

    /**
     * Send a PATCH request to the payment gateway
     */
    public function patch(string $url, array $formParams = [], array $query = [], array $headers = []): mixed;

    /**
     * Send a DELETE request to the payment gateway
     */
    public function delete(string $url, array $formParams = [], array $query = [], array $headers = []): mixed;

    public function decodeResponse(): array;
}
