<?php

declare(strict_types=1);

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\PaymentVerificationException;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;

// ──────────────────────────────────────────────
// Legacy contract mock tests (kept for interface contract coverage)
// ──────────────────────────────────────────────

it('can instantiate PaystackContract instance', function () {
    expect($this->paystack)
        ->toBeObject()
        ->toBeInstanceOf(PaystackContract::class);
});

it('can redirect to checkout for payment using passed arguments', function () {
    $this->paystack
        ->shouldReceive('redirectToCheckout')
        ->once()
        ->with([
            'amount' => 1000,
            'email' => 'musahmusah@test.com',
            'reference' => '123456789',
            'callback_url' => 'https://example.com',
        ])
        ->andReturn(new RedirectResponse('https://checkout.paystack.com/123456789'));

    expect($this->paystack->redirectToCheckout([
        'amount' => 1000,
        'email' => 'musahmusah@test.com',
        'reference' => '123456789',
        'callback_url' => 'https://example.com',
    ]))
        ->toBeObject()
        ->toBeInstanceOf(RedirectResponse::class);
});

it('can redirect to checkout for payment using explicit arguments', function () {
    $data = [
        'amount' => 5000,
        'email' => 'another@test.com',
        'currency' => 'NGN',
    ];

    $this->paystack
        ->shouldReceive('redirectToCheckout')
        ->once()
        ->with($data)
        ->andReturn(new RedirectResponse('https://checkout.paystack.com/abcdef123'));

    expect($this->paystack->redirectToCheckout($data))
        ->toBeObject()
        ->toBeInstanceOf(RedirectResponse::class);
});

it('can get the list of all banks', function () {
    $this->paystack
        ->shouldReceive('getBanks')
        ->once()
        ->andReturn(new PaymentResponse(true, 'Banks retrieved', ['*']));

    $result = $this->paystack->getBanks();

    expect($result)
        ->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Banks retrieved');
});

// ──────────────────────────────────────────────
// Http::fake() integration tests using real service
// ──────────────────────────────────────────────

it('verifies a transaction successfully using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/transaction/verify/ref_123' => Http::response([
            'status' => true,
            'message' => 'Verification successful',
            'data' => [
                'status' => 'success',
                'reference' => 'ref_123',
                'amount' => 10000,
                'currency' => 'NGN',
                'channel' => 'card',
                'gateway_response' => 'Successful',
                'customer' => ['email' => 'test@example.com'],
            ],
        ]),
    ]);

    $paystack = new PaystackService;
    $result = $paystack->verifyTransaction('ref_123');

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Verification successful')
        ->and($result->get('status'))->toBe('success')
        ->and($result->get('reference'))->toBe('ref_123')
        ->and($result->get('amount'))->toBe(10000)
        ->and($result->get('currency'))->toBe('NGN')
        ->and($result->get('channel'))->toBe('card')
        ->and($result->get('gateway_response'))->toBe('Successful');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'transaction/verify/ref_123')
        && $request->method() === 'GET'
        && $request->hasHeader('Authorization', 'Bearer sk_test_paystack_secret')
    );
});

it('can make fake http request to get list of banks', function () {
    $body = file_get_contents(__DIR__.'/../Fixtures/banks.json');

    Http::fake([
        'https://api.paystack.co/bank' => Http::response($body),
    ]);

    expect(json_decode($body, true))
        ->toBeArray()
        ->toHaveKeys([
            'status',
            'message',
            'data',
        ]);
});

it('gets banks from Paystack API using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/bank' => Http::response([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => [
                ['id' => 1, 'name' => 'Access Bank', 'code' => '044'],
                ['id' => 2, 'name' => 'Zenith Bank', 'code' => '057'],
            ],
        ]),
    ]);

    $paystack = new PaystackService;
    $result = $paystack->getBanks();

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->message)->toBe('Banks retrieved')
        ->and($result->data)->toBeArray();

    Http::assertSent(fn ($request) => str_contains($request->url(), '/bank')
        && $request->method() === 'GET'
    );
});

it('throws PaymentVerificationException for failed transaction', function () {
    Http::fake([
        'api.paystack.co/transaction/verify/bad_ref' => Http::response([
            'status' => true,
            'message' => 'Verification successful',
            'data' => [
                'status' => 'failed',
                'reference' => 'bad_ref',
                'amount' => 5000,
                'currency' => 'NGN',
                'channel' => 'card',
                'gateway_response' => 'Declined',
                'customer' => ['email' => 'test@example.com'],
            ],
        ]),
    ]);

    $paystack = new PaystackService;
    $paystack->getPaymentData('bad_ref');
})->throws(PaymentVerificationException::class);

it('redirects to checkout using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/transaction/initialize' => Http::response([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => [
                'authorization_url' => 'https://checkout.paystack.com/abc123',
                'access_code' => 'abc123',
                'reference' => 'ref_abc123',
            ],
        ]),
    ]);

    $paystack = new PaystackService;
    $response = $paystack->redirectToCheckout([
        'amount' => 10000,
        'email' => 'test@example.com',
    ]);

    expect($response)->toBeInstanceOf(RedirectResponse::class);

    Http::assertSent(fn ($request) => str_contains($request->url(), 'transaction/initialize')
        && $request->method() === 'POST'
    );
});

it('creates a transfer recipient using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/transferrecipient' => Http::response([
            'status' => true,
            'message' => 'Transfer recipient created successfully',
            'data' => [
                'active' => true,
                'createdAt' => '2023-01-01T00:00:00.000Z',
                'currency' => 'NGN',
                'domain' => 'test',
                'id' => 1,
                'integration' => 100073,
                'name' => 'Test User',
                'recipient_code' => 'RCP_test123',
                'type' => 'nuban',
                'updatedAt' => '2023-01-01T00:00:00.000Z',
                'is_deleted' => false,
            ],
        ]),
    ]);

    $paystack = new PaystackService;
    $result = $paystack->createTransferRecipient([
        'type' => 'nuban',
        'name' => 'Test User',
        'account_number' => '0123456789',
        'bank_code' => '044',
        'currency' => 'NGN',
    ]);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->successful)->toBeTrue()
        ->and($result->get('recipient_code'))->toBe('RCP_test123');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'transferrecipient')
        && $request->method() === 'POST'
    );
});
