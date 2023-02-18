<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait TransferTrait
{
    const TRANSFER_ENDPOINT = '/transfers/';

    const BULK_TRANFER_ENDPOINT = '/bulk-transfers/';

    /**
     * Initiate a Transfer with Flutterwave
     *
     * This method allows you to Initate a transfer with Flutterwave
     *
     * @param  array  $formParams
     * @return array
     */
    public function initiateTransfer($formParams)
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::TRANSFER_ENDPOINT);

        $transferData = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            formParams: $formParams,
            isJsonRequest: true
        );

        return $transferData;
    }

    /**
     * Get all transfers
     *
     * This method allows the developer/merchant to retrieve all their transfers.
     *
     * @param  array  $queryParams
     * @return array
     */
    public function getAllTransfers($queryParams = [])
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::TRANSFER_ENDPOINT);

        $paymentPlans = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $paymentPlans;
    }

    /**
     * Get Transfer fees
     *
     * This method allows the merchant/developer query the fee for the transfer being made.
     *
     * @return array
     */
    public function getTransferFees(array $queryParams = [])
    {
        $endpoint = sprintf('%s%s/fee', $this->baseUri, self::TRANSFER_ENDPOINT);

        $transferFees = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $transferFees;
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
     * @return array
     */
    public function createBulkTransfer(array $bulkTransferData, string $title = '')
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::TRANSFER_ENDPOINT);

        $requestPayload = [
            'title' => $title,
            'bulk_data' => $bulkTransferData,
        ];

        $bulkTransfers = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            formParams: $requestPayload,
            isJsonRequest: true
        );

        return $bulkTransfers;
    }

    /**
     * Fetch a Transfer
     *
     * This method helps you fetch the details of a transfer.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retrieve
     * @return array
     */
    public function getTransfer(int $transferId)
    {
        $endpoint = sprintf('%s%s%s', $this->baseUri, self::TRANSFER_ENDPOINT, $transferId);

        $response = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }

    /**
     * Get Transfer Rates
     *
     * This method allows you to query the transfer rate for international transfers.
     *
     * @return array
     */
    public function getTransferRates(array $queryParams)
    {
        $endpoint = sprintf('%s%s/rates', $this->baseUri, self::TRANSFER_ENDPOINT);

        $transferRates = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $transferRates;
    }

    /**
     * Retry a Transfer
     *
     * This method allows you to retry a previously failed transfer.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retry
     * @return array
     */
    public function retryTransfer(int $transferId)
    {
        $endpoint = sprintf('%s%s/retries', $this->baseUri, self::TRANSFER_ENDPOINT, $transferId);

        $tranferData = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $tranferData;
    }

    /**
     * Fetch a Transfer Retry
     *
     * This method allows you to fetch the details of a transfer retry.
     *
     * @param  int  $transferId - The unique ID of the transfer you want to retry
     * @return array
     */
    public function getTransferRetry(int $transferId)
    {
        $endpoint = sprintf('%s%s/retries', $this->baseUri, self::TRANSFER_ENDPOINT, $transferId);

        $tranferData = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $tranferData;
    }

    /**
     * Fetch a Bulk Transfer
     *
     * This method allows you to get the status and details of a bulk transfer.
     *
     * @return array
     */
    public function fetchBulkTransfer(array $queryParams)
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::TRANSFER_ENDPOINT);

        $tranferData = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $tranferData;
    }
}
