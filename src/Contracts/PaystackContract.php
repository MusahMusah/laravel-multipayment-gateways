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
     *
     * @param  array|null  $data
     * @return RedirectResponse
     */
    public function redirectToCheckout(array $data = null): RedirectResponse;

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     *
     * @return array
     *
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException|PaymentVerificationException
     */
    public function getPaymentData(): array;

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     *
     * @param  string  $reference
     * @return array|object
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function verifyTransaction(string $reference): array|object;

    /**
     * Hit Paystack's API to get all the Banks
     *
     * @return mixed
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getBanks(): mixed;

    /**
     * Hit Paystack's API to resolve a bank account
     *
     * @param  string  $accountNumber
     * @param  string  $bankCode
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function resolveAccountNumber(string $accountNumber, string $bankCode): mixed;

    /**
     * Hit Paystack's API to create a Transfer Recipient
     *
     * @param  string  $name
     * @param  string  $accountNumber
     * @param  string  $bankCode
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createTransferRecipient(string $name, string $accountNumber, string $bankCode): mixed;

    /**
     * Hit Paystack's API to create bulk transfers recipients
     *
     * @param  array  $recipients
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function createBulkTransferRecipients(array $recipients): mixed;

    /**
     * Hit Paystack's API to initiate a Transfer
     *
     * @param  int  $amount
     * @param  string  $reference
     * @param  string  $recipient
     * @param  string  $reason
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateTransfer(int $amount, string $reference, string $recipient, string $reason): mixed;

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     *
     * @param  array  $transfers
     * @return mixed
     *
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function initiateBulkTransfer(array $transfers): mixed;

    /**
     * Hit Paystack's API to finalize a Transfer
     */
    public function finalizeTransfer(string $transferCode, string $otp): mixed;

    /**
     * Hit Paystack's API to verify a Transfer
     */
    public function verifyTransfer(string $reference): mixed;

    /**
     * Hit Paystack's API to fetch a Transfer
     */
    public function fetchTransfer(string $transferCode): mixed;

    /**
     * Hit Paystack's API to fetch all Transfers
     */
    public function fetchTransfers(): mixed;
}
