<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;

class Flutterwave extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FlutterwaveContract::class;
    }
}
