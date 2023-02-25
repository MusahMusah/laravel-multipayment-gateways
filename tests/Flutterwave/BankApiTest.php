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

it('can get the list of all banks by country code', function () {
    $this->flutterwave
        ->shouldReceive('getBanks')
        ->once()
        ->andReturn([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => ['*'],
        ]);

    $location = 'NG';

    expect($this->flutterwave->getBanks($location))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => ['*'],
        ]);
});

it('can retrieve all bank branches for a given bank ID', function () {
    $bankID = 280;

    $this->flutterwave
        ->shouldReceive('getBankBranches')
        ->once()
        ->withArgs([$bankID]) // pass in the bank ID
        ->andReturn([
            'status' => true,
            'message' => 'Bank branches retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getBankBranches($bankID))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Bank branches retrieved',
            'data' => ['*'],
        ]);
});
