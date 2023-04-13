<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

/**
 * @method static HttpClientWrapper httpClient()
 * @method static HttpClientWrapper get(string $url, array $query = [], array $headers = [])
 * @method static HttpClientWrapper post(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper put(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper delete(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper patch(string $url, array $formParams = [], array $query = [], array $headers = [])
 *
 * @see \MusahMusah\LaravelMultipaymentGateways\Gateways\FlutterwaveService
 */
class Flutterwave extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FlutterwaveContract::class;
    }
}
