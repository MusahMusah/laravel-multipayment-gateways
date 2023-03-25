<?php

namespace MusahMusah\LaravelMultipaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

/**
 * @method static array getTransaction(string $reference)
 * @method static array getAllTransactions(array $payload)
 * @method static array verifyTransaction(string $reference)
 * @method static array getBanks()
 * @method static array resolveAccountNumber(string $accountNumber, string $bankCode)
 * @method static array createTransferRecipient(string $name, string $accountNumber, string $bankCode)
 * @method static array createBulkTransferRecipients(array $recipients)
 * @method static array initiateTransfer(int $amount, string $reference, string $recipient, string $reason)
 * @method static array initiateBulkTransfer(array $transfers)
 * @method static array finalizeTransfer(string $transferCode, string $otp)
 * @method static array verifyTransfer(string $reference)
 * @method static array getTransfer(string $transferCode)
 * @method static array getAllTransfers()
 *
 * @return \MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService
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
