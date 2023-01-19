<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;
use MusahMusah\LaravelMultipaymentGateways\Traits\ConsumesExternalServices;

class PaystackService implements PaystackContract
{
    use ConsumesExternalServices;

    /**
     * The base uri to consume the Paystack's service
     *
     * @var string
     */
    protected string $baseUri;

    /**
     * The secret to consume the Paystack's service
     *
     * @var string
     */
    protected string $secret;

    /**
     * The redirect url to consume the Paystack's service
     *
     * @var string
     */
    protected string $redirectUrl;

    /**
     * The payload to initiate the transaction
     *
     * @var array
     */
    protected array $payload;

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
     * Hit Paystack's API to initiate the transaction and generate the authorization URL
     *
     * @return array
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    private function generateCheckoutLink(): array
    {
        if (empty($this->payload)) {
            $this->payload = [
                'amount' => (int)request()->amount,
                'email' => request()->email,
                'first_name' => request()->first_name,
                'last_name' => request()->last_name,
                'plan' => request()->plan,
                'currency' => request()->currency ?? config('multipayment-gateways.paystack.currency') ?? 'NGN',
                'metadata' => request()->metadata,

                'subaccount' => request()->subaccount,
                'transaction_charge' => request()->transaction_charge,

                "split_code" => request()->split_code,
                "split" => request()->split,

                'reference' => request()->reference,
                'callback_url' => request()->callback_url,
            ];
        }

        return $this->makeRequest(
            method: 'POST',
            requestUrl: 'transaction/initialize',
            formParams: $this->payload,
        );
    }

    /**
     * Get the authorization URL from Paystack's API
     *
     * @return self
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    private function getAuthorizationUrl(): self
    {
        $this->generateCheckoutLink();
        $this->redirectUrl = $this->getData()['authorization_url'];

        return $this;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectRequest(): \Illuminate\Http\RedirectResponse
    {
        return redirect($this->redirectUrl);
    }

    /**
     * Redirect the user to Paystack's payment checkout page
     *
     * @param array|null $data
     * @return RedirectResponse
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    public function redirectToCheckout(array $data = null): \Illuminate\Http\RedirectResponse
    {
        is_null($data) ?: $this->payload = $data;

        return $this->getAuthorizationUrl()->redirectRequest();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     *
     * @return array
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    public function getPaymentData(): array
    {
        $this->validateTransaction();

        return $this->getData();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment
     * @return void
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    private function validateTransaction(): void
    {
        $this->verifyTransaction(reference: request()->reference ?? request()->trxref);

        if ($this->getData()['status'] !== 'success') throw new PaymentVerificationException();
    }

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     *
     * @param string $reference
     * @return array
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
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
     * @param string $accountNumber
     * @param string $bankCode
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
     * @param string $name
     * @param string $accountNumber
     * @param string $bankCode
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
                'currency' => config('multipayment-gateways.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to create bulk transfers recipients
     *
     * @param array $recipients
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
     * @param int $amount
     * @param string $reference
     * @param string $recipient
     * @param string $reason
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
                'currency' => config('multipayment-gateways.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     *
     * @param array $transfers
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
                'currency' => config('multipayment-gateways.paystack.currency') ?? 'NGN',
            ],
            isJsonRequest: true
        );
    }

    /**
     * Hit Paystack's API to finalize a Transfer
     *
     * @param string $transferCode
     * @param string $otp
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
     * @param string $reference
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
     * @param string $transferCode
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
