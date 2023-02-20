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
        return $this->makeRequest(
            method: 'GET',
            requestUrl: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT,
            isJsonRequest: true,
            queryParams: $queryParams
        );
    }

    /**
     * Activate a Subscription
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function activateSubscription(int $subscriptionId): array
    {
        return $this->makeRequest(
            method: 'PUT',
            requestUrl: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT.$subscriptionId.'/activate',
            isJsonRequest: true
        );
    }

    /**
     * Deactivate a Subscription
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function deactivateSubscription(int $subscriptionId): array
    {
        return $this->makeRequest(
            method: 'PUT',
            requestUrl: FlutterwaveConstant::SUBSCRIPTION_ENDPOINT.$subscriptionId.'/cancel',
            isJsonRequest: true
        );
    }
}
