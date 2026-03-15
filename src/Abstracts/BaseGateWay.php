<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Abstracts;

use MusahMusah\LaravelMultipaymentGateways\Contracts\GatewayContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

abstract class BaseGateWay implements GatewayContract
{
    /**
     * The base uri to consume the payment gateway's service
     */
    protected string $baseUri;

    /**
     * The secret to consume the payment gateway's service
     */
    protected string $secret;

    /**
     * The payment gateway name
     */
    protected string $paymentGateway;

    /**
     * Runtime config overrides passed at instantiation time
     */
    protected array $runtimeConfig = [];

    public function __construct(array $runtimeConfig = [])
    {
        $this->runtimeConfig = $runtimeConfig;
        $this->setPaymentGateway();
        $this->setBaseUri();
        $this->setSecret();
    }

    /**
     * Return the gateway name string used as config key
     */
    abstract protected function gatewayName(): string;

    /**
     * Return a new instance of the concrete gateway with the given runtime config.
     * Credentials supplied here take precedence over environment / config values.
     */
    final public function withConfig(array $config): static
    {
        return new static($config);
    }

    /**
     * Set the payment gateway name
     */
    final public function setPaymentGateway(): void
    {
        $this->paymentGateway = $this->gatewayName();
    }

    /**
     * Instantiate the http client wrapper class to make it available to the gateway classes.
     * Uses resolveAccessToken() so the wrapper's withToken() call works correctly.
     */
    final public function httpClient(): HttpClientWrapper
    {
        return new HttpClientWrapper(baseUri: $this->baseUri, secret: $this->resolveAccessToken());
    }

    /**
     * Resolve the access token - defaults to Bearer token.
     * Override in gateway subclasses that use a different auth flow.
     */
    protected function resolveAccessToken(): string
    {
        return $this->secret;
    }

    /**
     * Set the base uri to consume the payment gateway's service
     *
     * @throws InvalidConfigurationException
     */
    protected function setBaseUri(): void
    {
        $baseUri = $this->runtimeConfig['base_uri'] ?? config("multipayment-gateways.{$this->gatewayName()}.base_uri");

        if (! $baseUri) {
            throw new InvalidConfigurationException("The Base URI for `{$this->paymentGateway}` is missing. Please ensure that the `base_uri` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->baseUri = $baseUri;
    }

    /**
     * Set the secret to consume the payment gateway's service
     *
     * @throws InvalidConfigurationException
     */
    protected function setSecret(): void
    {
        $secret = $this->runtimeConfig['secret'] ?? config("multipayment-gateways.{$this->gatewayName()}.secret");

        if (! $secret) {
            throw new InvalidConfigurationException("The secret key for `{$this->paymentGateway}` is missing. Please ensure that the `secret` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->secret = $secret;
    }
}
