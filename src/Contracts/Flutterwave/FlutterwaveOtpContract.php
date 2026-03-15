<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveOtpContract
{
    public function createOtp(array $formParams): PaymentResponse;

    public function verifyOtp(string $reference, array $formParams): PaymentResponse;
}
