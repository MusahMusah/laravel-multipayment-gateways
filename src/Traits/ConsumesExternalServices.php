<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpClientException;
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
     * @throws GuzzleException|HttpMethodFoundException|HttpClientException
     */
    public function makeRequest(string $method, string $requestUrl, array|string $formParams = [], bool $isJsonRequest = false, array $queryParams = [], array $headers = [], bool $skipResolve = false): mixed
    {
        $this->validateRequest($method);

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (method_exists($this, 'resolveAuthorization') && ! $skipResolve) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        try {
            $response = $client->request($method, $requestUrl, [
                $isJsonRequest ? 'json' : 'form_params' => $formParams,
                'headers' => [
                    ...$headers,
                    'Content-Type' => $isJsonRequest ? 'application/json' : 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',

                ],
                'query' => $queryParams,
            ]);
        } catch (GuzzleException $e) {
            throw new HttpClientException($e->getMessage());
        }

        $this->response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $this->response = $this->decodeResponse();
        }

        return $this->response;
    }

    /**
     * @throws HttpMethodFoundException
     */
    private function validateRequest(string $method): void
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            throw new HttpMethodFoundException('Method not found');
        }
    }
}
