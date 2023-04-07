<?php

use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

it('can take url from any payment gateway in HttpClientWrapper', function () {
    // randomly pick a base uri from the config
    $baseUri = [array_rand([
        'https://api.paystack.co',
        'https://api.stripe.com',
        'https://api.flutterwave.com',
    ])];

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

    expect($this->httpClientWrapper->post(url: '/customer', formParams: $payload))->toBeArray();
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

    expect($this->httpClientWrapper->put(url: '/customer', formParams: $payload))
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

    expect($this->httpClientWrapper->patch(url: '/customer', formParams: $payload))
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
