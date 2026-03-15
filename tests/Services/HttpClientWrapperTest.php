<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

it('can take url from any payment gateway in HttpClientWrapper', function () {
    // randomly pick a base uri from the config
    $urls = [
        'https://api.paystack.co',
        'https://api.stripe.com',
        'https://api.flutterwave.com',
    ];
    $baseUri = $urls[array_rand($urls)];

    $httpClientWrapper = new HttpClientWrapper(baseUri: $baseUri, secret: 'sk_test_123456789');

    expect($httpClientWrapper)
        ->toBeObject()
        ->toBeInstanceOf(HttpClientWrapper::class);
});

it('can use httpClient() method in paystack gateway class', function () {
    $this->paystack
        ->shouldReceive('httpClient')
        ->once()
        ->andReturn(new HttpClientWrapper(baseUri: 'https://api.paystack.cosz', secret: 'sk_test_123456789'));

    expect($this->paystack->httpClient())
        ->toBeObject()
        ->toBeInstanceOf(HttpClientWrapper::class);
});

it('can use httpClient() method in stripe gateway class', function () {
    $this->stripe
        ->shouldReceive('httpClient')
        ->once()
        ->andReturn(new HttpClientWrapper(baseUri: 'https://api.stripe.com', secret: 'sk_test_123456789'));

    expect($this->stripe->httpClient())
        ->toBeObject()
        ->toBeInstanceOf(HttpClientWrapper::class);
});

it('can use httpClient() method in flutterwave gateway class', function () {
    $this->flutterwave
        ->shouldReceive('httpClient')
        ->once()
        ->andReturn(new HttpClientWrapper(baseUri: 'https://api.flutterwave.com', secret: 'sk_test_123456789'));

    expect($this->flutterwave->httpClient())
        ->toBeObject()
        ->toBeInstanceOf(HttpClientWrapper::class);
});

it('can use httpClient()->get() method to make http request', function () {
    $this->httpClientWrapper->shouldReceive('get')
        ->once()
        ->andReturn(['status' => true]);

    expect($this->httpClientWrapper->get(url: ''))
        ->toBeArray();
});

it('can use httpClient()->post() method to make http request', function () {
    $payload = [
        'amount' => 1000,
        'email' => 'musahmusah@mail.com',
        'reference' => '123456789',
    ];

    $this->httpClientWrapper->shouldReceive('post')
        ->once()
        ->with('/customer', $payload)
        ->andReturn(['status' => true]);

    expect($this->httpClientWrapper->post(url: '/customer', data: $payload))->toBeArray();
});

it('can use httpClient()->put() method to make http request', function () {
    $payload = [
        'amount' => 1000,
        'email' => 'musahmusah@mail.com',
        'reference' => '123456789',
    ];

    $this->httpClientWrapper->shouldReceive('put')
        ->once()
        ->with('/customer', $payload)
        ->andReturn(['status' => true]);

    expect($this->httpClientWrapper->put(url: '/customer', data: $payload))
        ->toBeArray();
});

it('can use httpClient()->patch() method to make http request', function () {
    $payload = [
        'amount' => 1000,
        'email' => 'musahmusah@mail.com',
        'reference' => '123456789',
    ];

    $this->httpClientWrapper->shouldReceive('patch')
        ->once()
        ->with('/customer', $payload)
        ->andReturn(['status' => true]);

    expect($this->httpClientWrapper->patch(url: '/customer', data: $payload))
        ->toBeArray();
});

it('can use httpClient()->delete() method to make http request', function () {
    $this->httpClientWrapper->shouldReceive('delete')
        ->once()
        ->with('/customer')
        ->andReturn(['status' => true]);

    expect($this->httpClientWrapper->delete(url: '/customer'))
        ->toBeArray();
});

// ──────────────────────────────────────────────
// Http::fake() integration tests for HttpClientWrapper
// ──────────────────────────────────────────────

it('sends GET request correctly using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/bank' => Http::response([
            'status' => true,
            'message' => 'Banks retrieved',
            'data' => [['name' => 'Access Bank', 'code' => '044']],
        ]),
    ]);

    $wrapper = new HttpClientWrapper('https://api.paystack.co', 'sk_test_secret');
    $result = $wrapper->get('/bank');

    expect($result)->toBeArray()
        ->and($result['status'])->toBeTrue();

    Http::assertSent(fn ($request) => str_contains($request->url(), '/bank')
        && $request->method() === 'GET'
        && $request->hasHeader('Authorization', 'Bearer sk_test_secret')
    );
});

it('sends POST request with JSON body using Http::fake()', function () {
    Http::fake([
        'api.paystack.co/transaction/initialize' => Http::response([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => ['authorization_url' => 'https://checkout.paystack.com/test'],
        ]),
    ]);

    $wrapper = new HttpClientWrapper('https://api.paystack.co', 'sk_test_secret');
    $result = $wrapper->post('/transaction/initialize', [
        'amount' => 10000,
        'email' => 'test@example.com',
    ]);

    expect($result)->toBeArray()
        ->and($result['status'])->toBeTrue()
        ->and($result['data']['authorization_url'])->toBe('https://checkout.paystack.com/test');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'transaction/initialize')
        && $request->method() === 'POST'
    );
});

it('sends DELETE request using Http::fake()', function () {
    Http::fake([
        'api.flutterwave.com/v3/beneficiaries/123' => Http::response([
            'status' => 'success',
            'message' => 'Beneficiary deleted',
            'data' => null,
        ]),
    ]);

    $wrapper = new HttpClientWrapper('https://api.flutterwave.com/v3', 'FLWSECK_TEST_secret');
    $result = $wrapper->delete('/beneficiaries/123');

    expect($result)->toBeArray()
        ->and($result['status'])->toBe('success');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'beneficiaries/123')
        && $request->method() === 'DELETE'
    );
});
