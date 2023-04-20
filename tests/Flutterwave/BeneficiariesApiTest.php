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

it('can create a transfer beneficiary', function () {

    $beneficiaryPayload = [
        'account_bank' => '044',
        'account_number' => '0690000032',
        'beneficiary_name' => 'Flutterwave Developers',
        'currency' => 'NGN',
        'bank_name' => 'Beneficiary Bank'
    ];

    $this->flutterwave
        ->shouldReceive('createTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryPayload])
        ->andReturn([
            'status' => 'success',
            'message' => 'Transfer beneficiary created',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->createTransferBeneficiary($beneficiaryPayload))
        ->toBeArray()
        ->toBe([
            'status' => 'success',
            'message' => 'Transfer beneficiary created',
            'data' => ['*'],
        ]);
});

it('can delete a transfer beneficiary a subscription', function () {

    $beneficiaryId = 1234;

    $this->flutterwave
        ->shouldReceive('deleteTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryId])
        ->andReturn([
            'status' => true,
            'message' => 'Transfer beneficiary deleted',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->deleteTransferBeneficiary($beneficiaryId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Transfer beneficiary deleted',
            'data' => ['*'],
        ]);
});

it('can get information for a transfer beneficiary', function () {

    $beneficiaryId = 1234;

    $this->flutterwave
        ->shouldReceive('getTransferBeneficiary')
        ->once()
        ->withArgs([$beneficiaryId])
        ->andReturn([
            'status' => true,
            'message' => 'Beneficiary retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getTransferBeneficiary($beneficiaryId))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'Beneficiary retrieved',
            'data' => ['*'],
        ]);
});

it('can get information for all transfer beneficiaries', function () {

    $queryParams = ['page' => 1];

    $this->flutterwave
        ->shouldReceive('getAllTransferBeneficiaries')
        ->once()
        ->withArgs([$queryParams])
        ->andReturn([
            'status' => true,
            'message' => 'All Transfer Beneficiaries retrieved',
            'data' => ['*'],
        ]);

    expect($this->flutterwave->getAllTransferBeneficiaries($queryParams))
        ->toBeArray()
        ->toBe([
            'status' => true,
            'message' => 'All Transfer Beneficiaries retrieved',
            'data' => ['*'],
        ]);
});
