<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;

it('can instantiate StripeContract instance', function () {
    expect($this->stripe)
        ->toBeObject()
        ->toBeInstanceOf(StripeContract::class);
});

it('can create a payment intent', function () {
    $this->stripe
        ->shouldReceive('createIntent')
        ->with([
            'amount' => 1000,
            'currency' => 'NGN',
            'payment_method_types' => ['card'],
            'description' => 'Test payment',
            'metadata' => [
                'order_id' => '123456789',
            ],
        ])
        ->once()
        ->andReturn(['status' => true]);

    expect($this->stripe->createIntent([
        'amount' => 1000,
        'currency' => 'NGN',
        'payment_method_types' => ['card'],
        'description' => 'Test payment',
        'metadata' => [
            'order_id' => '123456789',
        ],
    ]))->toBeArray();
});

it('can confirm payment with payment intent', function () {
    $this->stripe
        ->shouldReceive('confirmIntent')
        ->with('pi_123456789')
        ->once()
        ->andReturn(['status' => true]);

    expect($this->stripe->confirmIntent('pi_123456789'))->toBeArray();
});
