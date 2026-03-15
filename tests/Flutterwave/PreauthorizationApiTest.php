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
        ->andReturn(new PaymentResponse(true, 'Preauth charge created', ['*']));

    $result = $this->flutterwave->initiateCardCharge($payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Preauth charge created');
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
        ->andReturn(new PaymentResponse(true, 'Charge captured successfully', ['*']));

    $result = $this->flutterwave->captureCharge($transactionRef, $payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Charge captured successfully');
});

it('can void a charge', function () {
    $transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';

    $this->flutterwave
        ->shouldReceive('voidCharge')
        ->once()
        ->withArgs([$transactionRef])
        ->andReturn(new PaymentResponse(true, 'Charge void successfully', ['*']));

    $result = $this->flutterwave->voidCharge($transactionRef);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Charge void successfully');
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
        ->andReturn(new PaymentResponse(true, 'Refund created successfully', ['*']));

    $result = $this->flutterwave->createRefund($transactionRef, $payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Refund created successfully');
});

it('can capture a paypal charge', function () {
    $payload = [
        'flw_ref' => 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101',
    ];

    $this->flutterwave
        ->shouldReceive('capturePaypalCharge')
        ->once()
        ->withArgs([$payload])
        ->andReturn(new PaymentResponse(true, 'Charge captured successfully', ['*']));

    $result = $this->flutterwave->capturePaypalCharge($payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Charge captured successfully');
});

it('can void a paypal charge', function () {
    $payload = [
        'flw_ref' => 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101',
    ];

    $this->flutterwave
        ->shouldReceive('voidPaypalCharge')
        ->once()
        ->withArgs([$payload])
        ->andReturn(new PaymentResponse(true, 'Charge void successfully', ['*']));

    $result = $this->flutterwave->voidPaypalCharge($payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Charge void successfully');
});
