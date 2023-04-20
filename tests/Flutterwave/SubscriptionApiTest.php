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

it('can activate a subscription', function () {

    $subscriptionId = 1234;

    $this->flutterwave
        ->shouldReceive('activateSubscription')
        ->once()
        ->withArgs([$subscriptionId])
        ->andReturn([
            'status' => true,
            'message' => 'Subscription activated',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->activateSubscription($subscriptionId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Subscription activated',
            'data' => ['*'],
        ]);
});

it('can deactivate a subscription', function () {

    $subscriptionId = 1234;

    $this->flutterwave
        ->shouldReceive('deactivateSubscription')
        ->once()
        ->withArgs([$subscriptionId])
        ->andReturn([
            'status' => true,
            'message' => 'Subscription deactivated',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->deactivateSubscription($subscriptionId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Subscription deactivated',
            'data' => ['*'],
        ]);
});

it('can get information for all subscriptions', function () {

    $queryParams = ['status' => 'active'];

    $this->flutterwave
        ->shouldReceive('getAllSubscriptions')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn([
            'status' => true,
            'message' => 'Subscriptions retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getAllSubscriptions($queryParams))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Subscriptions retrieved',
            'data' => ['*'],
        ]);
});
