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

it('can get information for all transactions', function () {

    $optionalPayload = [
        'page' => 2,
        'from' => '2021-12-31',
        'to' => '2021-06-01',
    ];

    $this->flutterwave
        ->shouldReceive('getTransactions')
        ->once()
        ->withArgs([$optionalPayload])
        ->andReturn([
            'status' => true,
            'message' => 'Transactions retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getTransactions($optionalPayload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transactions retrieved',
            'data' => ['*'],
        ]);
});

it('can get information for multiple refunds', function () {

    $optionalPayload = [
        'page' => 2,
        'from' => '2021-12-31',
        'to' => '2021-06-01',
    ];

    $this->flutterwave
        ->shouldReceive('getRefundTransactions')
        ->once()
        ->withArgs([$optionalPayload])
        ->andReturn([
            'status' => true,
            'message' => 'Refunds retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getRefundTransactions($optionalPayload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Refunds retrieved',
            'data' => ['*'],
        ]);
});

it('can get information for single refund', function () {

    $refundId = 200;

    $this->flutterwave
        ->shouldReceive('getRefundDetails')
        ->once()
        ->withArgs([$refundId])
        ->andReturn([
            'status' => true,
            'message' => 'Refund retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getRefundDetails($refundId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Refund retrieved',
            'data' => ['*'],
        ]);
});

it('can get verify a transaction', function () {

    $transactionId = 200;

    $this->flutterwave
        ->shouldReceive('verifyTransaction')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn([
            'status' => true,
            'message' => 'Transaction verified successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->verifyTransaction($transactionId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transaction verified successfully',
            'data' => ['*'],
        ]);
});

it('can create a transaction refund', function () {

    $transactionId = 200;

    $this->flutterwave
        ->shouldReceive('createTransactionRefund')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn([
            'status' => true,
            'message' => 'Transaction refund created successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->createTransactionRefund($transactionId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transaction refund created successfully',
            'data' => ['*'],
        ]);
});

it('can view a transaction timeline', function () {

    $transactionId = 200;

    $this->flutterwave
        ->shouldReceive('viewTransactionTimeline')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn([
            'status' => true,
            'message' => 'Transaction timeline retrieved successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->viewTransactionTimeline($transactionId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transaction timeline retrieved successfully',
            'data' => ['*'],
        ]);
});

it('can resend failed webhook', function () {

    $transactionId = 200;
    $optionalPayload = [
        'wait' => 1,
    ];
    $this->flutterwave
        ->shouldReceive('resendFailedWebhook')
        ->once()
        ->withArgs([$transactionId, $optionalPayload])
        ->andReturn([
            'status' => true,
            'message' => 'Failed webhook resent successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->resendFailedWebhook($transactionId, $optionalPayload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Failed webhook resent successfully',
            'data' => ['*'],
        ]);
});

it('can get transactions fee', function () {

    $payload = [
        'amount' => 20000,
        'currency' => 'NGN',
    ];

    $this->flutterwave
        ->shouldReceive('getTransactionFee')
        ->once()
        ->withArgs([$payload])
        ->andReturn([
            'status' => true,
            'message' => 'Transaction fees retrieved successfully',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getTransactionFee($payload))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transaction fees retrieved successfully',
            'data' => ['*'],
        ]);
});
