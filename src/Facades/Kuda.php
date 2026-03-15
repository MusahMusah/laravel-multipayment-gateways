<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\KudaContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\KudaService;

/**
 * @see KudaService
 */
class Kuda extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return KudaContract::class;
    }
}
