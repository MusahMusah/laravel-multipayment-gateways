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

it('can get the list of all banks by country code', function () {
    $this->flutterwave
        ->shouldReceive('getBanks')
        ->once()
        ->andReturn(new PaymentResponse(true, 'Banks retrieved', ['*']));

    $location = 'NG';

    $result = $this->flutterwave->getBanks($location);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Banks retrieved');
});

it('can retrieve all bank branches for a given bank ID', function () {
    $bankID = 280;

    $this->flutterwave
        ->shouldReceive('getBankBranches')
        ->once()
        ->withArgs([$bankID])
        ->andReturn(new PaymentResponse(true, 'Bank branches retrieved', ['*']));

    $result = $this->flutterwave->getBankBranches($bankID);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Bank branches retrieved');
});
