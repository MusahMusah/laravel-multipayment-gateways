<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

trait TransferTrait
{
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
