<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait SubscriptionTrait
{
    const SUBSCRIPTION_ENDPOINT = '/subscriptions/';

    /**
     * Get information for all subscriptions
     */
    public function getAllSubscriptions(array $queryParams = []): array
    {
        $endpoint = $this->baseUri.self::SUBSCRIPTION_ENDPOINT;

        $subscriptions = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $subscriptions;
    }

    /**
     * Activate a Subscription
     */
    public function activateSubscription(int $subscriptionId): array
    {
        $endpoint = $this->baseUri.self::SUBSCRIPTION_ENDPOINT.$subscriptionId.'/activate';

        $response = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }

    /**
     * Deactivate a Subscription
     */
    public function deactivateSubscription(int $subscriptionId): array
    {
        $endpoint = sprintf('%s%s%s/cancel', $this->baseUri, self::SUBSCRIPTION_ENDPOINT, $subscriptionId);

        $response = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }
}
