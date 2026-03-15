<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

class StripeService extends BaseGateWay implements StripeContract
{
    /**
     * Create a new payment intent
     */
    public function createIntent(array $data): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/v1/payment_intents',
                data: $data,
                asJson: false,
            )
        );
    }

    /**
     * Confirm a payment intent
     */
    public function confirmIntent(string $paymentIntentId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: "/v1/payment_intents/{$paymentIntentId}/confirm",
                asJson: false,
            )
        );
    }

    protected function gatewayName(): string
    {
        return 'stripe';
    }
}
