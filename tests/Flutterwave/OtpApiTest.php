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

it('can create an OTP', function () {
    $formParams = [
        'amount' => 100,
        'email' => 'test@example.com',
    ];

    $this->flutterwave
        ->shouldReceive('createOtp')
        ->once()
        ->withArgs([$formParams])
        ->andReturn(new PaymentResponse(true, 'OTP created', ['*']));

    $result = $this->flutterwave->createOtp($formParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('OTP created');
});

it('can verify an OTP', function () {
    $reference = 'FLW-MOCK-REFERENCE';
    $formParams = [
        'otp' => '123456',
        'reference' => $reference,
    ];

    $this->flutterwave
        ->shouldReceive('verifyOtp')
        ->once()
        ->withArgs([
            $reference,
            $formParams,
        ])
        ->andReturn(new PaymentResponse(true, 'OTP validated', ['*']));

    $result = $this->flutterwave->verifyOtp($reference, $formParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('OTP validated');
});
