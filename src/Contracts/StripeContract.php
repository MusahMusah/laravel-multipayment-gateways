<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

interface StripeContract
{
    /**
     * Resolve the authorization URL / Endpoint
     *
     * @param $queryParams
     * @param $formParams
     * @param $headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void;

    /**
     * Set the access token for the request
     *
     * @return string
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     *
     * @return mixed
     */
    public function decodeResponse(): mixed;

    /**
     * Create a new payment intent
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function createIntent(array $data): array;

    /**
     * Confirm a payment intent
     * @param string $paymentIntentId
     * @return array
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function confirmIntent(string $paymentIntentId): array;
}
