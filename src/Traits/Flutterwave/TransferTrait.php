<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait TransferTrait
{
    /**
     * Initiate a Transfer with Flutterwave
     *
     * This method allows you to Initate a transfer with Flutterwave
     */
    public function initiateTransfer(array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/transfers/',
                data: $formParams
            )
        );
    }

    /**
     * Get all transfers
     *
     * This method allows the developer/merchant to retrieve all their transfers.
     */
    public function getAllTransfers(array $queryParams = []): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/transfers/',
                query: $queryParams
            )
        );
    }

    /**
     * Get Transfer fees
     *
     * This method allows the merchant/developer query the fee for the transfer being made.
     */
    public function getTransferFees(array $queryParams = []): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/transfers/fee',
                query: $queryParams
            )
        );
    }

    /**
     * Create a Bulk transfer
     *
     * This method allows the developer/merchant to create a bulk transfer, i.e. a transfer attempt for multiple transfers.
     *
     *
     * @optional
     *
     * @param  string  $title  This is the title of the bulk transfer attempt.
     */
    public function createBulkTransfer(array $bulkTransferData, string $title = ''): PaymentResponse
    {
        $requestPayload = [
            'title' => $title,
            'bulk_data' => $bulkTransferData,
        ];

        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/bulk-transfers/',
                data: $requestPayload
            )
        );
    }

    /**
     * Fetch a Transfer
     *
     * This method helps you fetch the details of a transfer.
     *
     * @param  int  $transferId  - The unique ID of the transfer you want to retrieve
     */
    public function getTransfer(int $transferId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/transfers/'.$transferId,
            )
        );
    }

    /**
     * Get Transfer Rates
     *
     * This method allows you to query the transfer rate for international transfers.
     */
    public function getTransferRates(array $queryParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/transfers/rates',
                query: $queryParams
            )
        );
    }

    /**
     * Retry a Transfer
     *
     * This method allows you to retry a previously failed transfer.
     *
     * @param  int  $transferId  - The unique ID of the transfer you want to retry
     */
    public function retryTransfer(int $transferId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/transfers/'.$transferId.'/retries',
            )
        );
    }

    /**
     * Fetch a Transfer Retry
     *
     * This method allows you to fetch the details of a transfer retry.
     *
     * @param  int  $transferId  - The unique ID of the transfer you want to retry
     */
    public function getTransferRetry(int $transferId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/transfers/'.$transferId.'/retries',
            )
        );
    }

    /**
     * Fetch a Bulk Transfer
     *
     * This method allows you to get the status and details of a bulk transfer.
     */
    public function fetchBulkTransfer(array $queryParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/bulk-transfers/',
                query: $queryParams
            )
        );
    }
}
