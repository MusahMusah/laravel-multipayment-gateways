<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Enums;

enum PaymentGateway: string
{
    case Paystack = 'paystack';
    case Flutterwave = 'flutterwave';
    case Stripe = 'stripe';
    case Kuda = 'kuda';

    public function hmacAlgorithm(): string
    {
        return match ($this) {
            self::Paystack => 'sha512',
            self::Flutterwave, self::Stripe, self::Kuda => 'sha256',
        };
    }
}
