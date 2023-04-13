<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait TransferTrait
{
    /**
     * Initiate a Transfer with Flutterwave
     *
     * This method allows you to Initate a transfer with Flutterwave
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function initiateTransfer(array $formParams): array
    {
        return flutterwave()->httpClient()->post(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT,
            formParams: $formParams
        );
    }

    /**
     * Get all transfers
     *
     * This method allows the developer/merchant to retrieve all their transfers.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getAllTransfers(array $queryParams = []): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT,
            query: $queryParams
        );
    }

    /**
     * Get Transfer fees
     *
     * This method allows the merchant/developer query the fee for the transfer being made.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getTransferFees(array $queryParams = []): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT.'fee',
            query: $queryParams
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
     * @param  string  $title This is the title of the bulk transfer attempt.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function createBulkTransfer(array $bulkTransferData, string $title = ''): array
    {
        $requestPayload = [
            'title' => $title,
            'bulk_data' => $bulkTransferData,
        ];

        return flutterwave()->httpClient()->post(
            url: FlutterwaveConstant::BULK_TRANSFER_ENDPOINT,
            formParams: $requestPayload
        );
    }

    /**
     * Fetch a Transfer
     *
     * This method helps you fetch the details of a transfer.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retrieve
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getTransfer(int $transferId): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT.$transferId,
        );
    }

    /**
     * Get Transfer Rates
     *
     * This method allows you to query the transfer rate for international transfers.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getTransferRates(array $queryParams): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT.'rates',
            query: $queryParams
        );
    }

    /**
     * Retry a Transfer
     *
     * This method allows you to retry a previously failed transfer.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retry
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function retryTransfer(int $transferId): array
    {
        return flutterwave()->httpClient()->post(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT.$transferId.'/retries',
        );
    }

    /**
     * Fetch a Transfer Retry
     *
     * This method allows you to fetch the details of a transfer retry.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retry
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getTransferRetry(int $transferId): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::TRANSFER_ENDPOINT.$transferId.'/retries',
        );
    }

    /**
     * Fetch a Bulk Transfer
     *
     * This method allows you to get the status and details of a bulk transfer.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function fetchBulkTransfer(array $queryParams): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::BULK_TRANSFER_ENDPOINT,
            query: $queryParams
        );
    }
}
