<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface StripeContract extends GatewayContract
{
    /**
     * Create a new payment intent
     */
    public function createIntent(array $data): PaymentResponse;

    /**
     * Confirm a payment intent
     */
    public function confirmIntent(string $paymentIntentId): PaymentResponse;
}
