<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait BankTrait
{
    /**
     * Hit Paystack's API to get all the Banks
     */
    public function getBanks(): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(url: 'bank')
        );
    }

    /**
     * Hit Paystack's API to resolve a bank account
     */
    public function resolveAccountNumber(array $payload): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(url: 'bank/resolve', query: $payload)
        );
    }
}
