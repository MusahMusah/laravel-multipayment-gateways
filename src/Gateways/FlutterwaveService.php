<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\BankTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\OtpTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\PaymentPlanTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\SettlementTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\SubscriptionTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\TransferBeneficiaryTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\TransferTrait;

class FlutterwaveService implements FlutterwaveContract
{
    use ConsumesExternalServices;
    use BankTrait;
    use SettlementTrait;
    use SubscriptionTrait;
    use PaymentPlanTrait;
    use TransferBeneficiaryTrait;
    use TransferTrait;
    use OtpTrait;

    /**
     * The base uri to consume the Flutterwave's service
     *
     * @var string
     */
    protected $baseUri;

    /**
     * The secret to consume the Flutterwave's service
     *
     * @var string
     */
    protected $secret;

    /**
     * The redirect url to consume the Flutterwave's service
     */
    protected string $redirectUrl;

    /**
     * The payment gateway for the class
     */
    protected string $paymentGateway;

    /**
     * The payload to initiate the transaction
     */
    protected array $payload;

    public function __construct()
    {
        $this->setPaymentGateway();
        $this->setBaseUri();
        $this->setSecret();
    }

    /**
     * Set the payment gateway for the class
     */
    protected function setPaymentGateway()
    {
        $this->paymentGateway = 'flutterwave';
    }

    /**
     * Set the base URI for the API request
     *
     * @throws InvalidConfigurationException
     */
    protected function setBaseUri()
    {
        $baseUri = config('multipayment-gateways.flutterwave.base_uri');

        if (! $baseUri) {
            throw new InvalidConfigurationException("The Base URI for `{$this->paymentGateway}` is missing. Please ensure that the `base_uri` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->baseUri = $baseUri;
    }

    /**
     * Set the secret key for the API request
     *
     * @throws InvalidConfigurationException
     */
    protected function setSecret()
    {
        $secret = config('multipayment-gateways.flutterwave.secret');

        if (! $secret) {
            throw new InvalidConfigurationException("The secret key for `{$this->paymentGateway}` is missing. Please ensure that the `secret` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $this->secret = $secret;
    }

    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void
    {
        $headers['Authorization'] = $this->resolveAccessToken();
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
    public function decodeResponse(): mixed
    {
        return json_decode($this->response, true);
    }

    /**
     * Get the response
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }

    /**
     * Get the data from the response
     */
    public function getData(): mixed
    {
        return $this->getResponse()['data'];
    }
}
