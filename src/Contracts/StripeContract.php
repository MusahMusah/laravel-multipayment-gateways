<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

interface StripeContract
{
    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void;

    /**
     * Set the access token for the request
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     */
    public function decodeResponse(): mixed;

    /**
     * Create a new payment intent
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function createIntent(array $data): array;

    /**
     * Confirm a payment intent
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function confirmIntent(string $paymentIntentId): array;
}
