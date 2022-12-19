<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGateways
 */
class LaravelMultipaymentGateways extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGateways::class;
    }
}
