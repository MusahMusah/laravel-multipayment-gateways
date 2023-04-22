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

it('can get information for a settlement', function () {

    $settlementId = 1234;

    $this->flutterwave
        ->shouldReceive('getSettlement')
        ->once()
        ->withArgs([$settlementId])
        ->andReturn([
            'status' => true,
            'message' => 'Settlement retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getSettlement($settlementId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Settlement retrieved',
            'data' => ['*'],
        ]);
});

it('can get information for all settlements', function () {

    $queryParams = ['status' => 'successful'];

    $this->flutterwave
        ->shouldReceive('getAllSettlements')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn([
            'status' => true,
            'message' => 'Settlements retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getAllSettlements($queryParams))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Settlements retrieved',
            'data' => ['*'],
        ]);
});
