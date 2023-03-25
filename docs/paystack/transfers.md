# Transfer API

## Get All Transfer

Get all transfers.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

// Using Facade
$transfers = Paystack::getAllTransfers();

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfers = $paystack->getAllTransfers();
}

// Using Helper
$transfers = paystack()->getAllTransfers();
```

## Get Transfer

Get details of a single transfer.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transferId = 5;
// Using Facade
$transfer = Paystack::getTransfer($transferId);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfer = $paystack->getTransfer($transferId);
}

// Using Helper
$transfer = paystack()->getTransfer($transferId);
```

## Create Transfer Recipient
Create a new transfer recipient.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$recipientPayload = [
    "type" => "nuban",
    "name" => "John Doe",
    "account_number" => 0690000040,
    "bank_code" => 044,
];

// Using Facade
$recipient = Paystack::createTransferRecipient($recipientPayload);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $recipient = $paystack->createTransferRecipient($recipientPayload);
}

// Using Helper
$recipient = paystack()->createTransferRecipient($recipientPayload);

```

## Create Bulk Transfer Recipient
Create a new bulk transfer recipient.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$recipientPayload = [
    [
        "type" => "nuban",
        "name" => "John Doe",
        "account_number" => 0690000040,
        "bank_code" => 034,
        'currency' => 'NGN'
    ],
    [
        "type" => "nuban",
        "name" => "Jane Doe",
        "account_number" => 0690000041,
        "bank_code" => 044,
        'currency' => 'NGN'
    ],
];

// Using Facade
$recipient = Paystack::createBulkTransferRecipients($recipientPayload);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $recipient = $paystack->createBulkTransferRecipients($recipientPayload);
}

// Using Helper
$recipient = paystack()->createBulkTransferRecipients($recipientPayload);

```

## Initiate Transfer

Initiate a new transfer.

```php
use \MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transferPayload = [
    "source" => "balance", 
    "reason" => "Calm down", 
    "amount" => 3794800, 
    "recipient" => "RCP_gx2wn530m0i3w3m"
];

// Using Facade
$transfer = Paystack::initiateTransfer($transferPayload);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfer = $paystack->initiateTransfer($transferPayload);
}

// Using Helper
$transfer = paystack()->initiateTransfer($transferPayload);

```

## Initiate Bulk Transfer

Initiate a new bulk transfer.

```php
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;

$transferPayload = [
    "currency" => "NGN",
    "source" => "balance",
    "transfers" => [
        [
          "amount" => 50000,
          "recipient" => "RCP_db342dvqvz9qcrn", 
          "reference" => "ref_943899312"
        ],
        [
          "amount" => 50000,
          "recipient" => "RCP_db342dvqvz9qcrn",
          "reference" => "ref_943889313"
        ]
    ]
];

// Using Facade
$transfer = Paystack::initiateBulkTransfer($transferPayload);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfer = $paystack->initiateBulkTransfer($transferPayload);
}

// Using Helper
$transfer = paystack()->initiateBulkTransfer($transferPayload);

```


## Finalize Transfer

Finalize a transfer.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transferPayload = [
    "transfer_code" => "TRF_vsyqdmlzble3uii", 
    "otp" => "928783"
];

// Using Facade
$transfer = Paystack::finalizeTransfer($transferPayload);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfer = $paystack->finalizeTransfer($transferPayload);
}

// Using Helper
$transfer = paystack()->finalizeTransfer($transferPayload);

```

## Verify Transfer

Verify a transfer.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transferReference = "TRF_vsyqdmlzble3uii";

// Using Facade
$transfer = Paystack::verifyTransfer($transferReference);

// Using Dependency Injection
public function __invoke(PaystackContract $paystack)
{
    $transfer = $paystack->verifyTransfer($transferReference);
}

// Using Helper
$transfer = paystack()->verifyTransfer($transferReference);

```
