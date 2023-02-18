<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait PaymentPlanTrait
{
    const PAYMENT_PLAN_ENDPOINT = '/payment-plans/';

    /**
     * Create Payment Plan
     *
     * This method helps you create a payment plan
     *
     * @param  array  $planDetails The details of the plan.
     * @return array
     */
    public function createPaymentPlan(array $planDetails)
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT;

        $paymentPlan = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            formParams: $planDetails,
            isJsonRequest: true
        );

        return $paymentPlan;
    }

    /**
     * Update Payment Plan
     *
     * This method allows you update a payment plan
     *
     *  @param  int  $paymentPlanId The ID of the payment plan to update.
     *  @param  array  $planDetails The updated details of the plan.
     *  @return array
     */
    public function updatePaymentPlan(int $paymentPlanId, array $planDetails)
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT.$paymentPlanId;

        $paymentPlan = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            formParams: $planDetails,
            isJsonRequest: true
        );

        return $paymentPlan;
    }

    /**
     * Get all payment plans
     *
     * This method retrieves all payment plans on the account
     *
     * @param  array  $queryParams [optional] The query parameters array.
     */
    public function getAllPaymentPlans($queryParams = []): array
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT;

        $paymentPlans = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $paymentPlans;
    }

    /**
     * Get a Payment Plan
     *
     * This method allows you to retrieve a single payment plan based on its ID.
     *
     * @param  int  $paymentPlanId The ID of the payment plan to retrieve.
     * @return array
     */
    public function getPaymentPlan(int $paymentPlanId)
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT.$paymentPlanId;

        $paymentPlan = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $paymentPlan;
    }

    /**
     * Cancel a Payment Plan
     *
     * This method allows the merchant/developer cancel an existing payment plan.
     *
     * @param  int  $paymentPlanId - The unique ID of the payment plan you want to cancel
     * @return array
     */
    public function cancelPaymentPlan(int $paymentPlanId)
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT.$paymentPlanId.'/cancel';

        $response = $this->makeRequest(
            method: 'PUT',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }
}
