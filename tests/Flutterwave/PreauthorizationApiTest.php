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

it('can create a preauth charge', function () {

    $payload = [
        'card_number' => '*****',
        'cvv' => '157',
        'expiry_month' => '5',
        'expiry_year' => '22',
        'amount' => '20000',
        'fullname' => 'Flutterwave Developers',
        'tx_ref' => 'sample-ref',
        'currency' => 'NGN',
        'country' => 'NG',
        'email' => 'developers@flutterwavego.com',
        'redirect_url' => 'https://www.flutterwave.com/ng/',
        'preauthorize' => true,
        'meta' => [
            'customer_id' => '200',
        ],
    ];

    $this->flutterwave
        ->shouldReceive('initiateCardCharge')
        ->once()
        ->withArgs([$payload])
        ->andReturn([
            'status' => 'success',
            'message' => 'Preauth charge created',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->initiateCardCharge($payload))
        ->toBeArray()
        ->toBe([
            'status' => 'success',
            'message' => 'Preauth charge created',
            'data' => ['*'],
        ]);
});

it('can capture a charge', function () {

    $transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';
    $payload = [
        'amount' => '100',
    ];

    $this->flutterwave
        ->shouldReceive('captureCharge')
        ->once()
        ->withArgs([$transactionRef, $payload])
        ->andReturn([
            'status' => true,
            'message' => 'Charge captured successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->captureCharge($transactionRef, $payload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Charge captured successfully',
            'data' => ['*'],
        ]);
});

it('can void a charge', function () {

    $transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';

    $this->flutterwave
        ->shouldReceive('voidCharge')
        ->once()
        ->withArgs([$transactionRef])
        ->andReturn([
            'status' => true,
            'message' => 'Charge void successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->voidCharge($transactionRef))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Charge void successfully',
            'data' => ['*'],
        ]);
});

it('can create a refund for a charge', function () {

    $transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';
    $payload = [
        'amount' => '100',
    ];

    $this->flutterwave
        ->shouldReceive('createRefund')
        ->once()
        ->withArgs([$transactionRef, $payload])
        ->andReturn([
            'status' => true,
            'message' => 'Refund created successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->createRefund($transactionRef, $payload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Refund created successfully',
            'data' => ['*'],
        ]);
});

it('can capture a paypal charge', function () {

    $payload = [
        'flw_ref' => 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101',
    ];

    $this->flutterwave
        ->shouldReceive('capturePaypalCharge')
        ->once()
        ->withArgs([$payload])
        ->andReturn([
            'status' => true,
            'message' => 'Charge captured successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->capturePaypalCharge($payload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Charge captured successfully',
            'data' => ['*'],
        ]);
});

it('can void a paypal charge', function () {

    $payload = [
        'flw_ref' => 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101',
    ];

    $this->flutterwave
        ->shouldReceive('voidPaypalCharge')
        ->once()
        ->withArgs([$payload])
        ->andReturn([
            'status' => true,
            'message' => 'Charge void successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->voidPaypalCharge($payload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Charge void successfully',
            'data' => ['*'],
        ]);
});
