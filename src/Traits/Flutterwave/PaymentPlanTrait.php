<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait PaymentPlanTrait
{
    /**
     * Create Payment Plan
     *
     * This method helps you create a payment plan
     *
     * @param  array  $planDetails  The details of the plan.
     */
    public function createPaymentPlan(array $planDetails): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/payment-plans/',
                data: $planDetails,
            )
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
    public function updatePaymentPlan(int $paymentPlanId, array $planDetails): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->put(
                url: '/payment-plans/'.$paymentPlanId,
                data: $planDetails,
            )
        );
    }

    /**
     * Get all payment plans
     *
     * This method retrieves all payment plans on the account
     *
     * @param  array  $queryParams  [optional] The query parameters array.
     */
    public function getAllPaymentPlans(array $queryParams = []): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/payment-plans/',
                query: $queryParams
            )
        );
    }

    /**
     * Get a Payment Plan
     *
     * This method allows you to retrieve a single payment plan based on its ID.
     *
     * @param  int  $paymentPlanId  The ID of the payment plan to retrieve.
     */
    public function getPaymentPlan(int $paymentPlanId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/payment-plans/'.$paymentPlanId,
            )
        );
    }

    /**
     * Cancel a Payment Plan
     *
     * This method allows the merchant/developer cancel an existing payment plan.
     *
     * @param  int  $paymentPlanId  - The unique ID of the payment plan you want to cancel
     */
    public function cancelPaymentPlan(int $paymentPlanId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->put(
                url: '/payment-plans/'.$paymentPlanId.'/cancel',
            )
        );
    }
}
