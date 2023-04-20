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

it('can create an OTP', function () {

    $formParams = [
        'amount' => 100,
        'email' => 'test@example.com',
    ];

    $this->flutterwave
        ->shouldReceive('createOtp')
        ->once()
        ->withArgs([$formParams])
        ->andReturn([
            'status' => true,
            'message' => 'OTP created',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->createOtp($formParams))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'OTP created',
            'data' => ['*'],
        ]);
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
        ->andReturn([
            'status' => true,
            'message' => 'OTP validated',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->verifyOtp($reference, $formParams))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'OTP validated',
            'data' => ['*'],
        ]);
});
