<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait SubscriptionTrait
{
    /**
     * Get information for all subscriptions
     */
    public function getAllSubscriptions(array $queryParams = []): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/subscriptions/',
                query: $queryParams
            )
        );
    }

    /**
     * Activate a Subscription
     */
    public function activateSubscription(int $subscriptionId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->put(
                url: '/subscriptions/'.$subscriptionId.'/activate',
            )
        );
    }

    /**
     * Deactivate a Subscription
     */
    public function deactivateSubscription(int $subscriptionId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->put(
                url: '/subscriptions/'.$subscriptionId.'/cancel',
            )
        );
    }
}
