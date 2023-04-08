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
    public function createTransferRecipient(array $payload): array
    {
        return paystack()->httpClient()->post(url:'transferrecipient',formParams: $payload);

    }



    /**
     * Hit Paystack's API to create bulk transfers recipients
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createBulkTransferRecipients(array $recipients): array
    {
        return paystack()->httpClient()->post(url:'transferrecipient',formParams: [
            'batch' => $recipients,
        ]);

    }

    /**
     * Hit Paystack's API to initiate a Transfer
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function initiateTransfer(array $payload): array
    {

        return paystack()->httpClient()->post(url:'transfer',formParams: $payload);

    }

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function initiateBulkTransfer(array $transfers): mixed
    {
        return paystack()->httpClient()->post(url:'transfer/bulk',formParams: $transfers);

    }

    /**
     * Hit Paystack's API to finalize a Transfer
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function finalizeTransfer(array $payload): array
    {
        return paystack()->httpClient()->post(url:'transfer/finalize_transfer',formParams: $payload);

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
        return paystack()->httpClient()->get(url:"transfer/verify/{$reference}");
    }

    /**
     * Hit Paystack's API to fetch a Transfer
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
     */
    public function getTransfer(string $transferCode): array
    {

        return paystack()->httpClient()->get(url:"transfer/{$transferCode}");
    }

    /**
     * Hit Paystack's API to fetch all Transfers
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     * @throws InvalidConfigurationException
     */
    public function getAllTransfers(): array
    {
        return paystack()->httpClient()->get(url:"transfer");
    }

}
