<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

/**
 * @method static array verifyTransaction(string $reference)
 * @method static array getBanks()
 *
 * @see \MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService
 */
class Paystack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaystackContract::class;
    }
}
