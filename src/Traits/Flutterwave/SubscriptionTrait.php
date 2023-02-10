<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait SubscriptionTrait
{
    CONST SUBSCRIPTION_ENDPOINT = '/subscriptions/';

    /**
     * Get information for all subscriptions
     *
     * @param array $options An array of optional parameters to use in the API request
     * @option string $email The email of the subscriber
     * @option int $transaction_id The unique transaction identifier
     * @option int $plan The ID of the payment plan
     * @option string $subscribed_from The start date of the subscriptions in the format YYYY-MM-DD
     * @option string $subscribed_to The end date for a subscription in the format YYYY-MM-DD
     * @option string $next_due_from The start date of the next due subscriptions in the format YYYY-MM-DD
     * @option string $next_due_to The end date of the next due subscriptions in the format YYYY-MM-DD
     * @option int $page The page number to retrieve
     * @option string $status The status of the queried transactions. Can be either "active" or "cancelled"
     *
     * @return array An array of all subscription information
     */
    public function getAllSubscriptions(array $options = []) : array
    {
        $endpoint = $this->baseUri . self::SUBSCRIPTION_ENDPOINT;

        $settlements = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $options,
            isJsonRequest: true
        );

        return $settlements;
    }

    /**
     * Activate a Subscription
     *
     * @param int $subscriptionId
     *
     * @return array An array of subscription information
     */
    public function activateSubscription(int $subscriptionId) : array
    {
        $endpoint = $this->baseUri . self::SUBSCRIPTION_ENDPOINT . $subscriptionId . '/activate';

        $response = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }

    /**
    * Deactivate a Subscription
    *
    * @param int $subscriptionId
    *
    * @return array
    */
    public function deactivateSubscription(int $subscriptionId) : array
    {
        $endpoint = $this->baseUri . self::SUBSCRIPTION_ENDPOINT . $subscriptionId . '/cancel';

        $response = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }
}
