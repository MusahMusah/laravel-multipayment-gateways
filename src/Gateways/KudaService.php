<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\KudaContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

class KudaService extends BaseGateWay implements KudaContract
{
    public ?string $email = null;

    /**
     * Kuda uses a token-refresh flow: obtain a JWT via /account/gettoken,
     * then use it as the Bearer token for subsequent requests.
     */
    public function resolveAccessToken(): string
    {
        return (string) $this->retrieveApiToken();
    }

    public function retrieveApiToken(): mixed
    {
        return cache()->remember('kuda_token', now()->addMinutes(20), function () {
            $response = $this->httpClientForAuth()->post(
                url: '/account/gettoken',
                data: [
                    'email' => $this->email,
                    'apiKey' => $this->secret,
                ],
            );

            return $response['data'] ?? $response;
        });
    }

    protected function gatewayName(): string
    {
        return 'kuda';
    }

    /**
     * Override setSecret to also capture the email credential.
     *
     * @throws InvalidConfigurationException
     */
    protected function setSecret(): void
    {
        $secret = $this->runtimeConfig['secret'] ?? config('multipayment-gateways.kuda.secret');

        if (! $secret) {
            throw new InvalidConfigurationException("The secret key for `{$this->paymentGateway}` is missing. Please ensure that the `secret` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->secret = $secret;
        $this->email = $this->runtimeConfig['email'] ?? config('multipayment-gateways.kuda.email');
    }

    /**
     * Build a temporary HTTP client without a bearer token for the token-fetch request.
     */
    protected function httpClientForAuth(): HttpClientWrapper
    {
        return new HttpClientWrapper(
            baseUri: $this->baseUri,
            secret: '',
        );
    }
}
