<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use MusahMusah\LaravelMultipaymentGateways\Contracts\HttpClientWrapperContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpClientException;
use SensitiveParameter;

class HttpClientWrapper implements HttpClientWrapperContract
{
    public function __construct(
        protected string $baseUri,
        #[SensitiveParameter] protected string $secret,
    ) {}

    /**
     * Send a GET request to the payment gateway
     */
    public function get(string $url, array $query = [], array $headers = []): array
    {
        return $this->client()->withHeaders($headers)->get($url, $query)->json() ?? [];
    }

    /**
     * Send a POST request to the payment gateway
     */
    public function post(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array
    {
        $request = $this->client()->withHeaders($headers);

        if (! empty($query)) {
            $request = $request->withOptions(['query' => $query]);
        }

        $response = $asJson
            ? $request->post($url, $data)
            : $request->asForm()->post($url, $data);

        return $response->json() ?? [];
    }

    /**
     * Send a PUT request to the payment gateway
     */
    public function put(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array
    {
        $request = $this->client()->withHeaders($headers);

        if (! empty($query)) {
            $request = $request->withOptions(['query' => $query]);
        }

        $response = $asJson
            ? $request->put($url, $data)
            : $request->asForm()->put($url, $data);

        return $response->json() ?? [];
    }

    /**
     * Send a PATCH request to the payment gateway
     */
    public function patch(string $url, array $data = [], array $query = [], array $headers = [], bool $asJson = true): array
    {
        $request = $this->client()->withHeaders($headers);

        if (! empty($query)) {
            $request = $request->withOptions(['query' => $query]);
        }

        $response = $asJson
            ? $request->patch($url, $data)
            : $request->asForm()->patch($url, $data);

        return $response->json() ?? [];
    }

    /**
     * Send a DELETE request to the payment gateway
     */
    public function delete(string $url, array $data = [], array $query = [], array $headers = []): array
    {
        $request = $this->client()->withHeaders($headers);

        if (! empty($query)) {
            $request = $request->withOptions(['query' => $query]);
        }

        return $request->delete($url, $data)->json() ?? [];
    }

    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUri)
            ->withToken($this->secret)
            ->acceptJson()
            ->throw(function (Response $response, RequestException $e) {
                throw new HttpClientException(
                    message: $e->getMessage(),
                    statusCode: $response->status(),
                    responseBody: $response->json() ?? [],
                    previous: $e,
                );
            });
    }
}
