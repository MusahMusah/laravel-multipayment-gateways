<?php

declare(strict_types=1);

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

beforeEach(function () {
    $this->flutterwave = $this->mock(FlutterwaveContract::class);
});

it('can instantiate FlutterwaveContract instance', function () {
    expect($this->flutterwave)
        ->toBeObject()
        ->toBeInstanceOf(FlutterwaveContract::class);
});

it('can create a payment plan', function () {
    $planDetails = [
        'name' => 'Test Plan',
        'amount' => 1000,
        'interval' => 'monthly',
        'duration' => 12,
    ];

    $this->flutterwave
        ->shouldReceive('createPaymentPlan')
        ->once()
        ->withArgs([$planDetails])
        ->andReturn(new PaymentResponse(true, 'Payment plan created', ['*']));

    $result = $this->flutterwave->createPaymentPlan($planDetails);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Payment plan created');
});

it('can update a payment plan', function () {
    $paymentPlanId = 123;

    $planDetails = [
        'name' => 'New Payment Plan Name',
        'amount' => 5000,
    ];

    $this->flutterwave
        ->shouldReceive('updatePaymentPlan')
        ->once()
        ->withArgs([$paymentPlanId, $planDetails])
        ->andReturn(new PaymentResponse(true, 'Payment plan updated', ['*']));

    $result = $this->flutterwave->updatePaymentPlan($paymentPlanId, $planDetails);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Payment plan updated');
});

it('can get all payment plans', function () {
    $queryParams = ['status' => 'active'];

    $this->flutterwave
        ->shouldReceive('getAllPaymentPlans')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn(new PaymentResponse(true, 'Payment plans retrieved', ['*']));

    $result = $this->flutterwave->getAllPaymentPlans($queryParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Payment plans retrieved');
});

it('can get a payment plan', function () {
    $paymentPlanId = 123456789;

    $this->flutterwave
        ->shouldReceive('getPaymentPlan')
        ->once()
        ->withArgs([$paymentPlanId])
        ->andReturn(new PaymentResponse(true, 'Payment plan retrieved', ['*']));

    $result = $this->flutterwave->getPaymentPlan($paymentPlanId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Payment plan retrieved');
});

it('can cancel a payment plan', function () {
    $paymentPlanId = 1234;

    $this->flutterwave
        ->shouldReceive('cancelPaymentPlan')
        ->once()
        ->withArgs([$paymentPlanId])
        ->andReturn(new PaymentResponse(true, 'Payment plan cancelled', ['*']));

    $result = $this->flutterwave->cancelPaymentPlan($paymentPlanId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Payment plan cancelled');
});
