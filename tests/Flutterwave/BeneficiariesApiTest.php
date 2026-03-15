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

it('can create a transfer beneficiary', function () {
    $beneficiaryPayload = [
        'account_bank' => '044',
        'account_number' => '0690000032',
        'beneficiary_name' => 'Flutterwave Developers',
        'currency' => 'NGN',
        'bank_name' => 'Beneficiary Bank',
    ];

    $this->flutterwave
        ->shouldReceive('createTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryPayload])
        ->andReturn(new PaymentResponse(true, 'Transfer beneficiary created', ['*']));

    $result = $this->flutterwave->createTransferBeneficiary($beneficiaryPayload);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transfer beneficiary created');
});

it('can delete a transfer beneficiary a subscription', function () {
    $beneficiaryId = 1234;

    $this->flutterwave
        ->shouldReceive('deleteTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryId])
        ->andReturn(new PaymentResponse(true, 'Transfer beneficiary deleted', ['*']));

    $result = $this->flutterwave->deleteTransferBeneficiary($beneficiaryId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transfer beneficiary deleted');
});

it('can get information for a transfer beneficiary', function () {
    $beneficiaryId = 1234;

    $this->flutterwave
        ->shouldReceive('getTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryId])
        ->andReturn(new PaymentResponse(true, 'Beneficiary retrieved', ['*']));

    $result = $this->flutterwave->getTransferBeneficiary($beneficiaryId);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Beneficiary retrieved');
});

it('can get information for all transfer beneficiaries', function () {
    $queryParams = ['page' => 1];

    $this->flutterwave
        ->shouldReceive('getAllTransferBeneficiaries')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn(new PaymentResponse(true, 'All Transfer Beneficiaries retrieved', ['*']));

    $result = $this->flutterwave->getAllTransferBeneficiaries($queryParams);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('All Transfer Beneficiaries retrieved');
});
