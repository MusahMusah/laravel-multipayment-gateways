<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeContract;

class Stripe extends Facade
{
    protected static function getFacadeAccessor()
    {
        return StripeContract::class;
    }
}
