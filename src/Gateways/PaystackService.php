<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;

class PaystackService implements PaystackContract
{
    use ConsumesExternalServices;

    /**
     * The base uri to consume the Paystack's service
     *
     * @var string
     */
    protected $baseUri;

    /**
     * The secret to consume the Paystack's service
     *
     * @var string
     */
    protected $secret;

    /**
     * The redirect url to consume the Paystack's service
     *
     * @var string
     */
    protected $redirectUrl;

    public function __construct()
    {
        $this->baseUri = config('multipayment-gateways.paystack.base_uri');
        $this->secret = config('multipayment-gateways.paystack.secret');
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
     * Get the response
     *
     * @return mixed
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }

    /**
     * Get the data from the response
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->getResponse()['data'];
    }

    /**
     * Get the authorization URL from paystack
     *
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        return $this->getData()['authorization_url'];
    }

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     *
     * @param  string  $reference
     * @return array
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function verifyTransaction(string $reference): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transaction/verify/{$reference}"
        );
    }

    /**
     * Hit Paystack's API to get all the Banks
     *
     * @return mixed
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getBanks(): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'bank'
        );
    }

    /**
     * Hit Paystack's API to resolve a bank account
     *
     * @param  string  $accountNumber
     * @param  string  $bankCode
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function resolveAccountNumber(string $accountNumber, string $bankCode): mixed
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'bank/resolve',
            queryParams: [
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
            ]
        );
    }

    /**
     * Hit Paystack's API to create a Transfer Recipient
     *
     * @param  string  $name
     * @param  string  $accountNumber
     * @param  string  $bankCode
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createTransferRecipient(string $name, string $accountNumber, string $bankCode): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transferrecipient',
            formParams: [
                'type' => 'nuban',
                'name' => $name,
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
                'currency' => config('services.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to create bulk transfers recipients
     *
     * @param  array  $recipients
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createBulkTransferRecipients(array $recipients): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transferrecipient/bulk',
            formParams: [
                'batch' => $recipients,
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to initiate a Transfer
     *
     * @param  int  $amount
     * @param  string  $reference
     * @param  string  $recipient
     * @param  string  $reason
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateTransfer(int $amount, string $reference, string $recipient, string $reason): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transfer',
            formParams: [
                'source' => 'balance',
                'reason' => $reason,
                'amount' => $amount,
                'recipient' => $recipient,
                'reference' => $reference,
                'currency' => config('services.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     *
     * @param  array  $transfers
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateBulkTransfer(array $transfers): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transfer/bulk',
            formParams: [
                'source' => 'balance',
                'transfers' => $transfers,
                'currency' => config('services.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to finalize a Transfer
     *
     * @param  string  $transferCode
     * @param  string  $otp
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function finalizeTransfer(string $transferCode, string $otp): mixed
    {
        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transfer/finalize_transfer',
            formParams: [
                'transfer_code' => $transferCode,
                'otp' => $otp,
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to verify a Transfer
     *
     * @param  string  $reference
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function verifyTransfer(string $reference): mixed
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transfer/verify/{$reference}"
        );
    }

    /**
     * Hit Paystack's API to fetch a Transfer
     *
     * @param  string  $transferCode
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function fetchTransfer(string $transferCode): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transfer/{$transferCode}",
        );
    }

    /**
     * Hit Paystack's API to fetch all Transfers
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function fetchTransfers(): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'transfer',
        );
    }
}
