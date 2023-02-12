<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait ConsumesExternalServices
{
    /**
     * The response from the request
     */
    protected mixed $response;

    /**
     * Send a request to any service.
     *
     * @param  string  $method
     * @param  string  $requestUrl
     * @param  array  $formParams
     * @param  array  $queryParams
     * @param  array  $headers
     * @param  bool  $isJsonRequest
     * @return mixed
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function makeRequest(string $method, string $requestUrl, array $formParams = [], bool $isJsonRequest = false, array $queryParams = [], array $headers = []): mixed
    {
        $this->validateRequest($method);

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => [
                ...$headers,
                'Content-Type' => $isJsonRequest ? 'application/json' : 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ],
            'query' => $queryParams,
        ]);

        $this->response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $this->response = $this->decodeResponse();
        }

        return $this->response;
    }

    /**
     * @param  string  $method
     * @return void
     *
     * @throws HttpMethodFoundException
     */
    private function validateRequest(string $method): void
    {
        if (! in_array($method, ['GET', 'POST', 'DELETE'])) {
            throw new HttpMethodFoundException('Method not found');
        }
    }
}
