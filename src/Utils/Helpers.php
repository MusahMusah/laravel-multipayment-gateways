<?php

use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

if (! function_exists('paystack')) {
    function paystack()
    {
        return app()->make(PaystackContract::class);
    }
}
