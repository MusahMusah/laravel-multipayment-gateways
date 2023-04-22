<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

trait BankTrait
{
    /**
     * Hit Paystack's API to get all the Banks
     */
    public function getBanks(): array
    {
        return $this->httpClient()->get(url: 'bank');
    }

    /**
     * Hit Paystack's API to resolve a bank account
     */
    public function resolveAccountNumber(array $payload): array
    {
        return $this->httpClient()->get(url: 'bank/resolve', query: $payload);
    }
}
