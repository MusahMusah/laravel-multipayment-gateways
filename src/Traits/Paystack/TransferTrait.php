<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait TransferTrait
{
    /**
     * Hit Paystack's API to create a Transfer Recipient
     */
    public function createTransferRecipient(array $payload): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(url: 'transferrecipient', data: $payload)
        );
    }

    /**
     * Hit Paystack's API to create bulk transfers recipients
     */
    public function createBulkTransferRecipients(array $recipients): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(url: 'transferrecipient', data: [
                'batch' => $recipients,
            ])
        );
    }

    /**
     * Hit Paystack's API to initiate a Transfer
     */
    public function initiateTransfer(array $payload): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(url: 'transfer', data: $payload)
        );
    }

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     */
    public function initiateBulkTransfer(array $transfers): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(url: 'transfer/bulk', data: $transfers)
        );
    }

    /**
     * Hit Paystack's API to finalize a Transfer
     */
    public function finalizeTransfer(array $payload): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(url: 'transfer/finalize_transfer', data: $payload)
        );
    }

    /**
     * Hit Paystack's API to verify a Transfer
     */
    public function verifyTransfer(string $reference): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(url: "transfer/verify/{$reference}")
        );
    }

    /**
     * Hit Paystack's API to fetch a Transfer
     */
    public function getTransfer(string $transferCode): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(url: "transfer/{$transferCode}")
        );
    }

    /**
     * Hit Paystack's API to fetch all Transfers
     */
    public function getAllTransfers(): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(url: 'transfer')
        );
    }
}
