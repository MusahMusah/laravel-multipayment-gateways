<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;

/**
 * @method static HttpClientWrapper httpClient()
 * @method static HttpClientWrapper get(string $url, array $query = [], array $headers = [])
 * @method static HttpClientWrapper post(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper put(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper delete(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static HttpClientWrapper patch(string $url, array $formParams = [], array $query = [], array $headers = [])
 * @method static array getTransaction(string $reference)
 * @method static array getAllTransactions(array $payload)
 * @method static array verifyTransaction(string $reference)
 * @method static array getBanks()
 * @method static array resolveAccountNumber(array $payload)
 * @method static array createTransferRecipient(array $payload)
 * @method static array createBulkTransferRecipients(array $recipients)
 * @method static array initiateTransfer(int $amount, string $reference, string $recipient, string $reason)
 * @method static array initiateBulkTransfer(array $transfers)
 * @method static array finalizeTransfer(string $transferCode, string $otp)
 * @method static array verifyTransfer(string $reference)
 * @method static array getTransfer(string $transferCode)
 * @method static array getAllTransfers()
 *
 * @see PaystackService
 */
class Paystack extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaystackContract::class;
    }
}
