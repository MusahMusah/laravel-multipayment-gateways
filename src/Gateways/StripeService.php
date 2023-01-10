<?php

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;

class StripeService implements StripeContract
{
    use ConsumesExternalServices;

    /**
     * The base uri to consume the Stripe's service
     *
     * @var string
     */
    protected $baseUri;

    /**
     * The secret to consume the Stripe's service
     *
     * @var string
     */
    protected $secret;

    /**
     * The plans to consume the Stripe's service
     *
     * @var array
     */
    protected $plans;

    public function __construct()
    {
        $this->baseUri = config('multipayment-gateways.stripe.base_uri');
        $this->secret = config('multipayment-gateways.stripe.secret');
        $this->plans = config('multipayment-gateways.stripe.plans');
    }

    /**
     * Resolve the authorization URL / Endpoint
     *
     * @param $queryParams
     * @param $formParams
     * @param $headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    /**
     * Set the access token for the request
     *
     * @return string
     */
    public function resolveAccessToken(): string
    {
        return "Bearer {$this->secret}";
    }

    /**
     * Decode the response
     *
     * @return mixed
     */
    public function decodeResponse(): mixed
    {
        return json_decode($this->response, true);
    }

    /**
     * Create a new payment intent
     *
     * @param  array  $data
     * @return array
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function createIntent(array $data): array
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            $data,
        );
    }

    /**
     * Confirm a payment intent
     *
     * @param  string  $paymentIntentId
     * @return array
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function confirmIntent(string $paymentIntentId): array
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/confirm",
        );
    }
}
