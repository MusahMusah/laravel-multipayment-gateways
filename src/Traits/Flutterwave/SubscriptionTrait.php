<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait SubscriptionTrait
{
    /**
     * Get information for all subscriptions
     * @param array $queryParams
     * @return array
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
     * @param int $subscriptionId
     * @return array
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
     * @param int $subscriptionId
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function deactivateSubscription(int $subscriptionId): array
    {
        $endpoint = sprintf('%s%s%s/cancel', $this->baseUri, FlutterwaveConstant::SUBSCRIPTION_ENDPOINT, $subscriptionId);

        return $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );
    }
}
