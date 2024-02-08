<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use Illuminate\Http\RedirectResponse;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;

trait TransactionTrait
{
    /**
     * Hit Paystack's API to initiate the transaction and generate the authorization URL
     */
    private function generateCheckoutLink(): void
    {
        if (empty($this->payload)) {
            $this->payload = array_filter([
                'amount' => (int) request()->amount,
                'email' => request()->email,
                'first_name' => request()->first_name,
                'last_name' => request()->last_name,
                'plan' => request()->plan,
                'currency' => request()->currency ?? config('multipayment-gateways.paystack.currency') ?? 'NGN',
                'metadata' => request()->metadata,

                'subaccount' => request()->subaccount,
                'transaction_charge' => request()->transaction_charge,

                'split_code' => request()->split_code,
                'split' => request()->split,

                'reference' => request()->reference,
                'callback_url' => request()->callback_url,
            ]);
        }

        $this->makeRequest(
            method: 'POST',
            requestUrl: 'transaction/initialize',
            formParams: $this->payload,
        );
    }

    /**
     * Get the authorization URL from Paystack's API
     */
    private function getAuthorizationUrl(): self
    {
        $this->generateCheckoutLink();
        $this->redirectUrl = $this->getData()['authorization_url'];

        return $this;
    }

    private function redirectRequest(): RedirectResponse
    {
        return redirect($this->redirectUrl);
    }

    /**
     * Redirect the user to Paystack's payment checkout page
     */
    public function redirectToCheckout(?array $data = null): RedirectResponse
    {
        is_null($data) ?: $this->payload = $data;

        return $this->getAuthorizationUrl()->redirectRequest();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment and get the payment details
     *
     *
     * @throws PaymentVerificationException
     */
    public function getPaymentData(): array
    {
        $this->validateTransaction();

        return $this->getResponse();
    }

    /**
     * Hit Paystack's verify endpoint to validate the payment
     *
     *
     * @throws PaymentVerificationException
     */
    private function validateTransaction(): void
    {
        $this->verifyTransaction(reference: request()->reference ?? request()->trxref);

        if ($this->getData()['status'] !== 'success') {
            throw new PaymentVerificationException();
        }
    }

    /**
     * Hit Paystack's API to Verify that the transaction is valid
     */
    public function verifyTransaction(string $reference): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transaction/verify/{$reference}",
        );
    }

    /**
     * Hit Paystack's Api to get a transaction
     */
    public function getTransaction(string $reference): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transaction/{$reference}",
        );
    }

    /**
     * Hit Paystack's Api to get all transaction
     */
    public function getAllTransactions(): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: "transactions",
        );
    }
}
