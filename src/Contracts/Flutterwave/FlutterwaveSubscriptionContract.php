<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveSubscriptionContract
{
    public function getAllSubscriptions(array $queryParams = []): PaymentResponse;

    public function activateSubscription(int $subscriptionId): PaymentResponse;

    public function deactivateSubscription(int $subscriptionId): PaymentResponse;
}
