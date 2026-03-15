<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;


trait SubscriptionTrait
{
    /**
     * Get information for all subscriptions
     */
    public function getAllSubscriptions(array $queryParams = []): array
    {
        return $this->httpClient()->get(
            url: '/subscriptions/',
            query: $queryParams
        );
    }

    /**
     * Activate a Subscription
     */
    public function activateSubscription(int $subscriptionId): array
    {
        return $this->httpClient()->put(
            url: '/subscriptions/'.$subscriptionId.'/activate',
        );
    }

    /**
     * Deactivate a Subscription
     */
    public function deactivateSubscription(int $subscriptionId): array
    {
        return $this->httpClient()->put(
            url: '/subscriptions/'.$subscriptionId.'/cancel',
        );
    }
}
