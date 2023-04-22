<?php

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

class StripeService extends BaseGateWay implements StripeContract
{
    public function setPaymentGateway(): void
    {
        $this->paymentGateway = 'stripe';
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setBaseUri(): void
    {
        $baseUri = config('multipayment-gateways.stripe.base_uri');

        if (! $baseUri) {
            throw new InvalidConfigurationException("The Base URI for `{$this->paymentGateway}` is missing. Please ensure that the `base_uri` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->baseUri = $baseUri;
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setSecret(): void
    {
        $secret = config('multipayment-gateways.stripe.secret');

        if (! $secret) {
            throw new InvalidConfigurationException("The secret key for `{$this->paymentGateway}` is missing. Please ensure that the `secret` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->secret = $secret;
    }

    /**
     * Set the access token for the request
     */
    public function resolveAccessToken(): string
    {
        return "Bearer {$this->secret}";
    }

    /**
     * Decode the response
     */
    public function decodeResponse(): array
    {
        return json_decode($this->response, true);
    }

    /**
     * Create a new payment intent
     */
    public function createIntent(array $data): array
    {
        return $this->httpClient()->post(
            url: '/v1/payment_intents',
            formParams: $data,
        );
    }

    /**
     * Confirm a payment intent
     */
    public function confirmIntent(string $paymentIntentId): array
    {
        return $this->httpClient()->post(
            url: "/v1/payment_intents/{$paymentIntentId}/confirm",
        );
    }
}
