# Transaction API

## Get All Transactions

Get list of transactions.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$optionalPayload = [
    'perPage' => 50,
    'page' => 2,
    'from' => '2021-12-31',
    'to' => '2021-06-01',
];

// Using the facade
$transactions = Paystack::getAllTransactions($optionalPayload);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transactions = $paystack->getAllTransactions($optionalPayload);
}

// Using the helper function
$transactions = paystack()->getAllTransactions($optionalPayload);

```

## Get Transaction

Get a single transaction.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transactionId = "TRX_1234567890";

// Using the facade
$transactions = Paystack::getTransaction($transactionId);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transactions = $paystack->getTransaction($transactionId);
}

// Using the helper function
$transactions = paystack()->getTransaction($transactionId);

```

## Verify Transaction 

Verify a transaction.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transactionId = "Trx_1234567890";

// Using the facade
$transaction = Paystack::verifyTransaction($transactionId);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transaction = $paystack->verifyTransaction($transactionId);
}

// Using the helper function
$transaction = paystack()->verifyTransaction($transactionId);

```
