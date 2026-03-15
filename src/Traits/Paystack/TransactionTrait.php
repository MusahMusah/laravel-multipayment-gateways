<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;

trait TransactionTrait
{
    /**
     * Initialize a Paystack transaction and return the DTO.
     */
    public function initializeTransaction(array $data): PaymentResponse
    {
        $payload = array_filter([
            'amount' => (int) ($data['amount'] ?? 0),
            'email' => $data['email'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'plan' => $data['plan'] ?? null,
            'currency' => $data['currency'] ?? config('multipayment-gateways.paystack.currency', 'NGN'),
            'metadata' => $data['metadata'] ?? null,
            'subaccount' => $data['subaccount'] ?? null,
            'transaction_charge' => $data['transaction_charge'] ?? null,
            'split_code' => $data['split_code'] ?? null,
            'split' => $data['split'] ?? null,
            'reference' => $data['reference'] ?? null,
            'callback_url' => $data['callback_url'] ?? null,
        ]);

        return PaymentResponse::fromArray(
            $this->httpClient()->post('transaction/initialize', $payload)
        );
    }

    /**
     * Redirect the user to Paystack's payment checkout page.
     * Requires explicit data - no fallback to request().
     */
    public function redirectToCheckout(array $data): RedirectResponse
    {
        $response = $this->initializeTransaction($data);

        return redirect($response->get('authorization_url'));
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details.
     * Explicit reference required.
     *
     * @throws PaymentVerificationException
     */
    public function getPaymentData(string $reference): PaymentResponse
    {
        $result = $this->verifyTransaction($reference);

        if ($result->get('status') !== 'success') {
            throw new PaymentVerificationException;
        }

        return $result;
    }

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     */
    public function verifyTransaction(string $reference): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get("transaction/verify/{$reference}")
        );
    }

    /**
     * Hit Paystack's API to get a transaction
     */
    public function getTransaction(string $reference): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get("transaction/{$reference}")
        );
    }

    /**
     * Hit Paystack's API to get all transactions
     */
    public function getAllTransactions(): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get('transaction')
        );
    }
}
