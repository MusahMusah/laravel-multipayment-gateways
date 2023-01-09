<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeContract;

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
