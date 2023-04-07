<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

use MusahMusah\LaravelMultipaymentGateways\Contracts\HttpClientWrapperContract;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;

class HttpClientWrapper implements HttpClientWrapperContract
{
    use ConsumesExternalServices;

    public function __construct(protected $baseUri, protected $secret)
    {}

    /**
     * Send a GET request to the payment gateway
     */
    public function get(string $url, array $query = [], array $headers = []): mixed
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: $url,
            isJsonRequest: true,
            queryParams: $query,
            headers: $headers
        );
    }

    /**
     * Send a POST request to the payment gateway
     */
    public function post(string $url, array $formParams = [], array $query = [], array $headers = []): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: $url,
            formParams: $formParams,
            isJsonRequest: true,
            queryParams: $query,
            headers: $headers
        );
    }

    /**
     * Send a PUT request to the payment gateway
     */
    public function put(string $url, array $formParams = [], array $query = [], array $headers = []): mixed
    {
        return $this->makeRequest(
            method: 'PUT',
            requestUrl: $url,
            formParams: $formParams,
            isJsonRequest: true,
            queryParams: $query,
            headers: $headers
        );
    }

    /**
     * Send a PATCH request to the payment gateway
     */
    public function patch(string $url, array $formParams = [], array $query = [], array $headers = []): mixed
    {
        return $this->makeRequest(
            method: 'PATCH',
            requestUrl: $url,
            formParams: $formParams,
            isJsonRequest: true,
            queryParams: $query,
            headers: $headers
        );
    }

    /**
     * Send a DELETE request to the payment gateway
     */
    public function delete(string $url, array $formParams = [], array $query = [], array $headers = []): mixed
    {
        return $this->makeRequest(
            method: 'DELETE',
            requestUrl: $url,
            formParams: $formParams,
            isJsonRequest: true,
            queryParams: $query,
            headers: $headers
        );
    }

    private function resolveAuthorization(&$queryParams, &$formParams, &$headers): string
    {
        return $headers['Authorization'] = str_replace('"', '', "Bearer {$this->secret}");
    }

    public function decodeResponse(): array
    {
        return json_decode($this->response, true);
    }
}
