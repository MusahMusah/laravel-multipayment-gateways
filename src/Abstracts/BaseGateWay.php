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
     *
     * @var string|null
     */
    protected ?string $baseUri;

    /**
     * The secret to consume the payment gateway's service
     *
     * @var string|null
     */
    protected ?string $secret;

    /**
     * The redirect url to consume the payment gateway's service
     *
     * @var string
     */
    protected string $redirectUrl;

    /**
     * The payment gateway name
     *
     * @var string
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
     *
     * @return void
     */
    abstract public function setPaymentGateway(): void;

    /**
     * Set the base uri to consume the payment gateway's service
     *
     * @return void
     */
    abstract public function setBaseUri(): void;

    /**
     * Set the secret to consume the payment gateway's service
     *
     * @return void
     */
    abstract public function setSecret(): void;

    /**
     * Resolve the access token
     *
     * @return string
     */
    abstract public function resolveAccessToken(): string;

    /**
     * Decode the response
     *
     * @return array|string
     */
    abstract public function decodeResponse(): array|string;

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
//        dd(str_replace('"', '', $this->resolveAccessToken()));
        $headers['Authorization'] = str_replace('"', '', $this->resolveAccessToken());
    }

    /**
     * Get the response
     *
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * Get the data from the response
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->getResponse()['data'];
    }
}
