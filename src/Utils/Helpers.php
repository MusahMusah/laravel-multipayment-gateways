<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;

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
