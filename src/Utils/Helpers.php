<?php

declare(strict_types=1);

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\KudaContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\PaymentManager;

if (! function_exists('paystack')) {
    function paystack(): PaystackContract
    {
        return app()->make(PaystackContract::class);
    }
}

if (! function_exists('stripe')) {
    function stripe(): StripeContract
    {
        return app(StripeContract::class);
    }
}

if (! function_exists('flutterwave')) {
    function flutterwave(): FlutterwaveContract
    {
        return app(FlutterwaveContract::class);
    }
}

if (! function_exists('kuda')) {
    function kuda(): KudaContract
    {
        return app(KudaContract::class);
    }
}

if (! function_exists('payment')) {
    function payment(?string $driver = null): mixed
    {
        $manager = app(PaymentManager::class);

        return $driver ? $manager->driver($driver) : $manager;
    }
}
