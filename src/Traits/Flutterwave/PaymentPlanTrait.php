<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;

trait PaymentPlanTrait
{
    /**
     * Create Payment Plan
     *
     * This method helps you create a payment plan
     *
     * @param  array  $planDetails  The details of the plan.
     */
    public function createPaymentPlan(array $planDetails): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::PAYMENT_PLAN_ENDPOINT,
            formParams: $planDetails,
        );
    }

    /**
     * Update Payment Plan
     *
     * This method allows you update a payment plan
     *
     * @param  int  $paymentPlanId  The ID of the payment plan to update.
     * @param  array  $planDetails  The updated details of the plan.
     */
    public function updatePaymentPlan(int $paymentPlanId, array $planDetails): array
    {
        return $this->httpClient()->put(
            url: FlutterwaveConstant::PAYMENT_PLAN_ENDPOINT.$paymentPlanId,
            formParams: $planDetails,
        );
    }

    /**
     * Get all payment plans
     *
     * This method retrieves all payment plans on the account
     *
     * @param  array  $queryParams  [optional] The query parameters array.
     */
    public function getAllPaymentPlans(array $queryParams = []): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::PAYMENT_PLAN_ENDPOINT,
            query: $queryParams
        );
    }

    /**
     * Get a Payment Plan
     *
     * This method allows you to retrieve a single payment plan based on its ID.
     *
     * @param  int  $paymentPlanId  The ID of the payment plan to retrieve.
     */
    public function getPaymentPlan(int $paymentPlanId): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::PAYMENT_PLAN_ENDPOINT.$paymentPlanId,
        );
    }

    /**
     * Cancel a Payment Plan
     *
     * This method allows the merchant/developer cancel an existing payment plan.
     *
     * @param  int  $paymentPlanId  - The unique ID of the payment plan you want to cancel
     */
    public function cancelPaymentPlan(int $paymentPlanId): array
    {
        return $this->httpClient()->put(
            url: FlutterwaveConstant::PAYMENT_PLAN_ENDPOINT.$paymentPlanId.'/cancel',
        );
    }
}
