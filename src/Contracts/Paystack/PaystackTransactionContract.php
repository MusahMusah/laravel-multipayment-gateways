<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack;

use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface PaystackTransactionContract
{
    /**
     * Initialize a Paystack transaction
     */
    public function initializeTransaction(array $data): PaymentResponse;

    /**
     * Redirect the user to Paystack's payment checkout page
     */
    public function redirectToCheckout(array $data): RedirectResponse;

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     */
    public function getPaymentData(string $reference): PaymentResponse;

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     */
    public function verifyTransaction(string $reference): PaymentResponse;

    /**
     * Hit Paystack's API to get a transaction
     */
    public function getTransaction(string $reference): PaymentResponse;

    /**
     * Hit Paystack's API to get all transactions
     */
    public function getAllTransactions(): PaymentResponse;
}
