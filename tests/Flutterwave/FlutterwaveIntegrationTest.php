<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;
use MusahMusah\LaravelMultipaymentGateways\Gateways\FlutterwaveService;

it('verifies a Flutterwave transaction using Http::fake()', function () {
    Http::fake([
        'api.flutterwave.com/v3/transactions/12345/verify' => Http::response([
            'status' => 'success',
            'message' => 'Transaction fetched successfully',
            'data' => [
                'id' => 12345,
                'tx_ref' => 'my-ref-001',
                'flw_ref' => 'FLW-MOCK-test',
                'amount' => 2000,
                'currency' => 'NGN',
                'status' => 'successful',
                'customer' => ['email' => 'test@example.com'],
            ],
        ]),
    ]);

    $flutterwave = new FlutterwaveService;
    $result = $flutterwave->verifyTransaction('12345');

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Transaction fetched successfully')
        ->and($result->get('tx_ref'))->toBe('my-ref-001');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'transactions/12345/verify')
        && $request->method() === 'GET'
        && $request->hasHeader('Authorization', 'Bearer FLWSECK_TEST_flutterwave_secret')
    );
});

it('gets banks for a country using Http::fake()', function () {
    Http::fake([
        'api.flutterwave.com/v3/banks/NG' => Http::response([
            'status' => 'success',
            'message' => 'Banks fetched',
            'data' => [
                ['id' => 1, 'name' => 'Access Bank', 'code' => '044'],
                ['id' => 2, 'name' => 'Zenith Bank', 'code' => '057'],
            ],
        ]),
    ]);

    $flutterwave = new FlutterwaveService;
    $result = $flutterwave->getBanks('NG');

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Banks fetched')
        ->and($result->data)->toBeArray();

    Http::assertSent(fn ($request) => str_contains($request->url(), '/banks/NG')
        && $request->method() === 'GET'
    );
});

it('initiates a transfer using Http::fake()', function () {
    Http::fake([
        'api.flutterwave.com/v3/transfers/' => Http::response([
            'status' => 'success',
            'message' => 'Transfer Queued Successfully',
            'data' => [
                'id' => 1,
                'account_number' => '0690000040',
                'bank_name' => 'ACCESS BANK NIGERIA',
                'amount' => 5500,
                'currency' => 'NGN',
                'reference' => 'my-transfer-ref',
                'status' => 'NEW',
            ],
        ]),
    ]);

    $flutterwave = new FlutterwaveService;
    $result = $flutterwave->initiateTransfer([
        'account_bank' => '044',
        'account_number' => '0690000040',
        'amount' => 5500,
        'narration' => 'Test transfer',
        'currency' => 'NGN',
        'reference' => 'my-transfer-ref',
    ]);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->get('reference'))->toBe('my-transfer-ref');

    Http::assertSent(fn ($request) => str_contains($request->url(), '/transfers/')
        && $request->method() === 'POST'
    );
});
