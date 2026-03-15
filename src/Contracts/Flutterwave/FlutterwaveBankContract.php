<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveBankContract
{
    /**
     * Get list of banks for a given country by shortcode
     */
    public function getBanks(string $countryCode): PaymentResponse;

    /**
     * Get all branches of a bank
     */
    public function getBankBranches(int $bankId): PaymentResponse;
}
