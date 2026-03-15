<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface PaystackBankContract
{
    /**
     * Hit Paystack's API to get all the Banks
     */
    public function getBanks(): PaymentResponse;

    /**
     * Hit Paystack's API to resolve a bank account
     */
    public function resolveAccountNumber(array $payload): PaymentResponse;
}
