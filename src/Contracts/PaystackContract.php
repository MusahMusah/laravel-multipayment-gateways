<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;

interface PaystackContract
{
    /**
     * Redirect the user to Paystack's payment page
     */
    public function redirectToCheckout(?array $data = null): RedirectResponse;

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     *
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    public function getPaymentData(): array;

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function verifyTransaction(string $reference): array|object;

    /**
     * Hit Paystack's API to get all the Banks
     *
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getBanks(): mixed;

    /**
     * Hit Paystack's API to resolve a bank account
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function resolveAccountNumber(array $payload): array;

    /**
     * Hit Paystack's API to create a Transfer Recipient
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createTransferRecipient(array $payload): array;

    /**
     * Hit Paystack's API to create bulk transfers recipients
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createBulkTransferRecipients(array $recipients): array;

    /**
     * Hit Paystack's API to initiate a Transfer
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateTransfer(array $payload): array;

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     *
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateBulkTransfer(array $transfers): mixed;

    /**
     * Hit Paystack's API to finalize a Transfer
     */
    public function finalizeTransfer(array $payload): array;

    /**
     * Hit Paystack's API to verify a Transfer
     */
    public function verifyTransfer(string $reference): mixed;

    /**
     * Hit Paystack's API to fetch a Transfer
     */
    public function getTransfer(string $transferCode): mixed;

    /**
     * Hit Paystack's API to fetch all Transfers
     */
    public function getAllTransfers(): mixed;

    public function getTransaction(string $reference): array;

    public function getAllTransactions(): array;
}
