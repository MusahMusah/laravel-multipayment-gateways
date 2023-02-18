<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;

class PaystackService extends BaseGateWay implements PaystackContract
{
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

    /**
     * Hit Paystack's API to initiate the transaction and generate the authorization URL
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    private function generateCheckoutLink(): void
    {
        if (empty($this->payload)) {
            $this->payload = array_filter([
                'amount' => (int) request()->amount,
                'email' => request()->email,
                'first_name' => request()->first_name,
                'last_name' => request()->last_name,
                'plan' => request()->plan,
                'currency' => request()->currency ?? config('multipayment-gateways.paystack.currency') ?? 'NGN',
                'metadata' => request()->metadata,

                'subaccount' => request()->subaccount,
                'transaction_charge' => request()->transaction_charge,

                'split_code' => request()->split_code,
                'split' => request()->split,

                'reference' => request()->reference,
                'callback_url' => request()->callback_url,
            ]);
        }

        $this->makeRequest(
            method: 'POST',
            requestUrl: 'transaction/initialize',
            formParams: $this->payload,
        );
    }

    /**
     * Get the authorization URL from Paystack's API
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    private function getAuthorizationUrl(): self
    {
        $this->generateCheckoutLink();
        $this->redirectUrl = $this->getData()['authorization_url'];

        return $this;
    }

    private function redirectRequest(): RedirectResponse
    {
        return redirect($this->redirectUrl);
    }

    /**
     * Redirect the user to Paystack's payment checkout page
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    public function redirectToCheckout(array $data = null): RedirectResponse
    {
        is_null($data) ?: $this->payload = $data;

        return $this->getAuthorizationUrl()->redirectRequest();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    public function getPaymentData(): array
    {
        $this->validateTransaction();

        return $this->getData();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    private function validateTransaction(): void
    {
        $this->verifyTransaction(reference: request()->reference ?? request()->trxref);

        if ($this->getData()['status'] !== 'success') {
            throw new PaymentVerificationException();
        }
    }

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     *
     *
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
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
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
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
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
