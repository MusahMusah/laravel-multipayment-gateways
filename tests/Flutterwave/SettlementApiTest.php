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

it('can get information for a settlement', function () {
    $settlementId = 1234;

    $this->flutterwave
        ->shouldReceive('getSettlement')
        ->once()
        ->withArgs([$settlementId])
        ->andReturn(new PaymentResponse(true, 'Settlement retrieved', ['*']));

    $result = $this->flutterwave->getSettlement($settlementId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Settlement retrieved');
});

it('can get information for all settlements', function () {
    $queryParams = ['status' => 'successful'];

    $this->flutterwave
        ->shouldReceive('getAllSettlements')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn(new PaymentResponse(true, 'Settlements retrieved', ['*']));

    $result = $this->flutterwave->getAllSettlements($queryParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Settlements retrieved');
});
