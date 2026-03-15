<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwavePaymentPlanContract
{
    public function createPaymentPlan(array $planDetails): PaymentResponse;

    public function updatePaymentPlan(int $paymentPlanId, array $planDetails): PaymentResponse;

    public function getAllPaymentPlans(array $queryParams = []): PaymentResponse;

    public function getPaymentPlan(int $paymentPlanId): PaymentResponse;

    public function cancelPaymentPlan(int $paymentPlanId): PaymentResponse;
}
