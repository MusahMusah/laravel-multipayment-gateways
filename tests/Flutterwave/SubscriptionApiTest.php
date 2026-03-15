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

it('can activate a subscription', function () {
    $subscriptionId = 1234;

    $this->flutterwave
        ->shouldReceive('activateSubscription')
        ->once()
        ->withArgs([$subscriptionId])
        ->andReturn(new PaymentResponse(true, 'Subscription activated', ['*']));

    $result = $this->flutterwave->activateSubscription($subscriptionId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Subscription activated');
});

it('can deactivate a subscription', function () {
    $subscriptionId = 1234;

    $this->flutterwave
        ->shouldReceive('deactivateSubscription')
        ->once()
        ->withArgs([$subscriptionId])
        ->andReturn(new PaymentResponse(true, 'Subscription deactivated', ['*']));

    $result = $this->flutterwave->deactivateSubscription($subscriptionId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Subscription deactivated');
});

it('can get information for all subscriptions', function () {
    $queryParams = ['status' => 'active'];

    $this->flutterwave
        ->shouldReceive('getAllSubscriptions')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn(new PaymentResponse(true, 'Subscriptions retrieved', ['*']));

    $result = $this->flutterwave->getAllSubscriptions($queryParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Subscriptions retrieved');
});
