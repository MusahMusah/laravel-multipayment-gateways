<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

trait TransferTrait
{
    /**
     * Hit Paystack's API to create a Transfer Recipient
     */
    public function createTransferRecipient(array $payload): array
    {
        return $this->httpClient()->post(url: 'transferrecipient', formParams: $payload);
    }

    /**
     * Hit Paystack's API to create bulk transfers recipients
     */
    public function createBulkTransferRecipients(array $recipients): array
    {
        return $this->httpClient()->post(url: 'transferrecipient', formParams: [
            'batch' => $recipients,
        ]);
    }

    /**
     * Hit Paystack's API to initiate a Transfer
     */
    public function initiateTransfer(array $payload): array
    {
        return $this->httpClient()->post(url: 'transfer', formParams: $payload);
    }

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     */
    public function initiateBulkTransfer(array $transfers): mixed
    {
        return $this->httpClient()->post(url: 'transfer/bulk', formParams: $transfers);
    }

    /**
     * Hit Paystack's API to finalize a Transfer
     */
    public function finalizeTransfer(array $payload): array
    {
        return $this->httpClient()->post(url: 'transfer/finalize_transfer', formParams: $payload);
    }

    /**
     * Hit Paystack's API to verify a Transfer
     */
    public function verifyTransfer(string $reference): mixed
    {
        return $this->httpClient()->get(url: "transfer/verify/$reference");
    }

    /**
     * Hit Paystack's API to fetch a Transfer
     */
    public function getTransfer(string $transferCode): array
    {
        return $this->httpClient()->get(url: "transfer/$transferCode");
    }

    /**
     * Hit Paystack's API to fetch all Transfers
     */
    public function getAllTransfers(): array
    {
        return $this->httpClient()->get(url: 'transfer');
    }
}
