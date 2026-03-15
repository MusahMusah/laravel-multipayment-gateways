<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeService;

// ──────────────────────────────────────────────
// Legacy contract mock tests
// ──────────────────────────────────────────────

it('can instantiate StripeContract instance', function () {
    expect($this->stripe)
        ->toBeObject()
        ->toBeInstanceOf(StripeContract::class);
});

it('can create a payment intent', function () {
    $this->stripe
        ->shouldReceive('createIntent')
        ->with([
            'amount' => 1000,
            'currency' => 'NGN',
            'payment_method_types' => ['card'],
            'description' => 'Test payment',
            'metadata' => [
                'order_id' => '123456789',
            ],
        ])
        ->once()
        ->andReturn(new PaymentResponse(true, '', ['id' => 'pi_123']));

    $result = $this->stripe->createIntent([
        'amount' => 1000,
        'currency' => 'NGN',
        'payment_method_types' => ['card'],
        'description' => 'Test payment',
        'metadata' => [
            'order_id' => '123456789',
        ],
    ]);

    expect($result)->toBeInstanceOf(PaymentResponse::class);
});

it('can confirm payment with payment intent', function () {
    $this->stripe
        ->shouldReceive('confirmIntent')
        ->with('pi_123456789')
        ->once()
        ->andReturn(new PaymentResponse(true, '', ['id' => 'pi_123456789', 'status' => 'succeeded']));

    $result = $this->stripe->confirmIntent('pi_123456789');

    expect($result)->toBeInstanceOf(PaymentResponse::class);
});

// ──────────────────────────────────────────────
// Http::fake() integration tests using real service
// ──────────────────────────────────────────────

it('creates a payment intent using Http::fake()', function () {
    Http::fake([
        'api.stripe.com/v1/payment_intents' => Http::response([
            'id' => 'pi_test123',
            'object' => 'payment_intent',
            'amount' => 1000,
            'currency' => 'ngn',
            'status' => 'requires_payment_method',
        ]),
    ]);

    $stripe = new StripeService;
    $result = $stripe->createIntent([
        'amount' => 1000,
        'currency' => 'ngn',
        'payment_method_types' => ['card'],
    ]);

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->get('id'))->toBe('pi_test123')
        ->and($result->get('status'))->toBe('requires_payment_method');

    Http::assertSent(fn ($request) => str_contains($request->url(), '/v1/payment_intents')
        && $request->method() === 'POST'
        && $request->hasHeader('Authorization', 'Bearer sk_test_stripe_secret')
    );
});

it('confirms a payment intent using Http::fake()', function () {
    Http::fake([
        'api.stripe.com/v1/payment_intents/pi_test123/confirm' => Http::response([
            'id' => 'pi_test123',
            'object' => 'payment_intent',
            'status' => 'succeeded',
        ]),
    ]);

    $stripe = new StripeService;
    $result = $stripe->confirmIntent('pi_test123');

    expect($result)->toBeInstanceOf(PaymentResponse::class)
        ->and($result->get('id'))->toBe('pi_test123')
        ->and($result->get('status'))->toBe('succeeded');

    Http::assertSent(fn ($request) => str_contains($request->url(), '/v1/payment_intents/pi_test123/confirm')
        && $request->method() === 'POST'
    );
});
