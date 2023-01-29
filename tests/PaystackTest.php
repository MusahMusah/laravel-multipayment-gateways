<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

beforeEach(function () {
    $this->paystack = $this->mock(PaystackContract::class);
});

it('can get the list of all banks', function () {
    $this->paystack
        ->shouldReceive('getBanks')
        ->once()
        ->andReturn([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => '*',
        ]);

    expect($this->paystack->getBanks())
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => '*',
        ]);
});
