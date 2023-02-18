<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Abstracts;

use MusahMusah\LaravelMultipaymentGateways\Contracts\GatewayContract;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;

abstract class BaseGateWay implements GatewayContract
{
    use ConsumesExternalServices;

    /**
     * The base uri to consume the payment gateway's service
     */
    protected ?string $baseUri;

    /**
     * The secret to consume the payment gateway's service
     */
    protected ?string $secret;

    /**
     * The redirect url to consume the payment gateway's service
     */
    protected string $redirectUrl;

    /**
     * The payment gateway name
     */
    protected string $paymentGateway;

    public function __construct()
    {
        $this->setPaymentGateway();
        $this->setBaseUri();
        $this->setSecret();
    }

    /**
     * Set the payment gateway name
     */
    abstract public function setPaymentGateway(): void;

    /**
     * Set the base uri to consume the payment gateway's service
     */
    abstract public function setBaseUri(): void;

    /**
     * Set the secret to consume the payment gateway's service
     */
    abstract public function setSecret(): void;

    /**
     * Resolve the access token
     */
    abstract public function resolveAccessToken(): string;

    /**
     * Decode the response
     */
    abstract public function decodeResponse(): array|string;

    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void
    {
//        dd(str_replace('"', '', $this->resolveAccessToken()));
        $headers['Authorization'] = str_replace('"', '', $this->resolveAccessToken());
    }

    /**
     * Get the response
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * Get the data from the response
     */
    public function getData(): array
    {
        return $this->getResponse()['data'];
    }
}
