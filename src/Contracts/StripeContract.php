<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

interface StripeContract
{
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
