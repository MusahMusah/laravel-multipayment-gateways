<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait SubscriptionTrait
{
    /**
     * Get information for all subscriptions
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getAllSubscriptions(array $queryParams = []): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT,
            query: $queryParams
        );
    }

    /**
     * Activate a Subscription
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function activateSubscription(int $subscriptionId): array
    {
        return flutterwave()->httpClient()->put(
            url: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT.$subscriptionId.'/activate',
        );
    }

    /**
     * Deactivate a Subscription
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function deactivateSubscription(int $subscriptionId): array
    {
        return flutterwave()->httpClient()->put(
            url: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT.$subscriptionId.'/cancel',
        );
    }
}
