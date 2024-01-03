<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\BankTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\TransactionTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\TransferTrait;

class PaystackService extends BaseGateWay implements PaystackContract
{
    use BankTrait,
        TransactionTrait,
        TransferTrait;

    /**
     * The payload to initiate the transaction
     */
    protected array $payload;

    public function setPaymentGateway(): void
    {
        $this->paymentGateway = 'paystack';
    }

    /**
     * @throws InvalidConfigurationException
     */
    public function setBaseUri(): void
    {
        $baseUri = config('multipayment-gateways.paystack.base_uri');

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
        $secret = config('multipayment-gateways.paystack.secret');

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
}
