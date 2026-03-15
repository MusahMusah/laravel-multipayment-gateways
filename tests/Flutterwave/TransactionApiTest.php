<?php

declare(strict_types=1);

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

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
        ->andReturn(new PaymentResponse(true, 'Transactions retrieved', ['*']));

    $result = $this->flutterwave->getTransactions($optionalPayload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transactions retrieved');
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
        ->andReturn(new PaymentResponse(true, 'Refunds retrieved', ['*']));

    $result = $this->flutterwave->getRefundTransactions($optionalPayload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Refunds retrieved');
});

it('can get information for single refund', function () {
    $refundId = '200';

    $this->flutterwave
        ->shouldReceive('getRefundDetails')
        ->once()
        ->withArgs([$refundId])
        ->andReturn(new PaymentResponse(true, 'Refund retrieved', ['*']));

    $result = $this->flutterwave->getRefundDetails($refundId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Refund retrieved');
});

it('can get verify a transaction', function () {
    $transactionId = '200';

    $this->flutterwave
        ->shouldReceive('verifyTransaction')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn(new PaymentResponse(true, 'Transaction verified successfully', ['*']));

    $result = $this->flutterwave->verifyTransaction($transactionId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transaction verified successfully');
});

it('can create a transaction refund', function () {
    $transactionId = '200';

    $this->flutterwave
        ->shouldReceive('createTransactionRefund')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn(new PaymentResponse(true, 'Transaction refund created successfully', ['*']));

    $result = $this->flutterwave->createTransactionRefund($transactionId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transaction refund created successfully');
});

it('can view a transaction timeline', function () {
    $transactionId = '200';

    $this->flutterwave
        ->shouldReceive('viewTransactionTimeline')
        ->once()
        ->withArgs([$transactionId])
        ->andReturn(new PaymentResponse(true, 'Transaction timeline retrieved successfully', ['*']));

    $result = $this->flutterwave->viewTransactionTimeline($transactionId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transaction timeline retrieved successfully');
});

it('can resend failed webhook', function () {
    $transactionId = '200';
    $optionalPayload = [
        'wait' => 1,
    ];

    $this->flutterwave
        ->shouldReceive('resendFailedWebhook')
        ->once()
        ->withArgs([$transactionId, $optionalPayload])
        ->andReturn(new PaymentResponse(true, 'Failed webhook resent successfully', ['*']));

    $result = $this->flutterwave->resendFailedWebhook($transactionId, $optionalPayload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Failed webhook resent successfully');
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
        ->andReturn(new PaymentResponse(true, 'Transaction fees retrieved successfully', ['*']));

    $result = $this->flutterwave->getTransactionFee($payload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transaction fees retrieved successfully');
});
