<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait PaymentPlanTrait
{
    const PAYMENT_PLAN_ENDPOINT = '/payment-plans/';

    /**
     * Create Payment Plan
     * This method helps you create a payment plan
     *
     *  @param  array  $planDetails The details of the plan. It should include the following keys:
     *  - amount (int): The amount to charge all customers subscribed to this plan
     *  - name (string): The name of the payment plan
     *  - interval (string): The frequency of the charges for this plan.
     *                        Could be yearly, quarterly, monthly, weekly, daily, etc.
     * @return array An array containing the newly created payment plan
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
     * This method helps you update a payment plan
     *
     *  @param  int  $paymentPlanId The ID of the payment plan to update.
     *  @param  array  $planDetails The updated details of the plan. It can include the following keys:
     *  - name (string): The new name of the payment plan
     *  - status (string): The new status of the plan.
     * @return array An array containing the newly created payment plan
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
     * This function retrieves all payment plans on the account
     *
     * @param  array  $options [optional] The options array. It can include the following keys:
     *  - from (string): This is the specified date to start the list from. The expected date format is YYYY-MM-DD.
     *  - to (string): The is the specified end period for the search. The expected date format is YYYY-MM-DD.
     *  - page (int): This is the page number to retrieve e.g. setting 1 retrieves the first page.
     *  - amount (int): This is the exact amount set when creating the payment plan.
     *  - currency (string): This is the currency the payment plan amount is charged in.
     *  - interval (string): This is how often the payment plan is set to execute.
     *  - status (string): This is the status of the payment plan.
     * @return array An array of all payment plans information
     */
    public function getAllPaymentPlans($options = []): array
    {
        $endpoint = $this->baseUri.self::PAYMENT_PLAN_ENDPOINT;

        $paymentPlans = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $options,
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
     * @return array The payment plan data.
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
     * This endpoint helps the merchant/developer cancel an existing payment plan.
     *
     * @param  int  $paymentPlanId - The unique ID of the payment plan you want to cancel
     * @return array - The API response in the form of an array
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
