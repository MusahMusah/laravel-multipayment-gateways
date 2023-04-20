<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;

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
        ->andReturn([
            'status' => 'success',
            'message' => 'Payment plan created',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->createPaymentPlan($planDetails))
        ->toBeArray()
        ->toBe([
            'status' => 'success',
            'message' => 'Payment plan created',
            'data' => ['*'],
        ]);
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
        ->andReturn([
            'status' => true,
            'message' => 'Payment plan updated',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->updatePaymentPlan($paymentPlanId, $planDetails))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Payment plan updated',
            'data' => ['*'],
        ]);
});

it('can get all payment plans', function () {

    $queryParams = ['status' => 'active'];

    $this->flutterwave
        ->shouldReceive('getAllPaymentPlans')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn([
            'status' => 'success',
            'message' => 'Payment plans retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getAllPaymentPlans($queryParams))
        ->toBeArray()
        ->toBe([
            'status' => 'success',
            'message' => 'Payment plans retrieved',
            'data' => ['*'],
        ]);
});

it('can get a payment plan', function () {

    $paymentPlanId = 123456789;

    $this->flutterwave
        ->shouldReceive('getPaymentPlan')
        ->once()
        ->withArgs([$paymentPlanId])
        ->andReturn([
            'status' => true,
            'message' => 'Payment plan retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getPaymentPlan($paymentPlanId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Payment plan retrieved',
            'data' => ['*'],
        ]);
});

it('can cancel a payment plan', function () {

    $paymentPlanId = 1234;

    $this->flutterwave
        ->shouldReceive('cancelPaymentPlan')
        ->once()
        ->withArgs([$paymentPlanId])
        ->andReturn([
            'status' => 'success',
            'message' => 'Payment plan cancelled',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->cancelPaymentPlan($paymentPlanId))
        ->toBeArray()
        ->toBe([
            'status' => 'success',
            'message' => 'Payment plan cancelled',
            'data' => ['*'],
        ]);
});
