# Transfer API

## Get All Transfer

Get all transfers.

```php
$optionalPayload = [
    'page' => 1,
    'status' => 'successful',
    'from' => '2022-01-01',
    'to' => '2022-12-31'
];
$transfers = Flutterwave::getAllTransfers($payload);
```

## Get Transfer

Get details of a single transfer.

```php
$transferId = 200;
$transfer = Flutterwave::getTransfer($transferId);
```

## Get Transfer Fees

Get transfer fees.

```php
$payload = [
    'amount' => 20000,
    'currency' => "NGN",
    'type' => 'account'
];
$transferFees = Flutterwave::getTransferFees($payload);
```

## Get Transfer Rates

Get transfer rates.

```php
$payload = [
    'amount' => 1000,
    'destination_currency' => 'USD',
    'source_currency' => 'NGN'
];
$transferRates = Flutterwave::getTransferRates($payload);
```

## Initiate Transfer

Initiate a new transfer.

```php
$transferPayload = [
    "account_bank" => "044",
    "account_number" => "0690000040",
    "amount" => 5500,
    "narration" => "Payment for goods purchased",
    "currency" => "NGN",
    "beneficiary_name" => "John Doe",
    "destination_branch_code" => "Branch123",
    "debit_subaccount" => "PSA******07974",
    "beneficiary" => 123456,
    "reference" => "Ref12345",
    "callback_url" => "https =>//www.example.com/callback",
    "debit_currency" => "NGN",
    "meta" => [
      "additional_info" => "Payment for order #1234"
    ],
    "mobile_number" => "+2348123456789",
    "email" => "johndoe@example.com",
    "beneficiary_country" => "Nigeria",
    "beneficiary_occupation" => "Developer",
    "recipient_address" => "123 Main Street, Lagos, Nigeria",
    "sender" => "Jane Doe",
    "sender_country" => "Nigeria",
    "sender_id_number" => "ID123456789",
    "sender_id_type" => "PASSPORT",
    "sender_id_expiry" => "2025-12-31",
    "sender_mobile_number" => "+2348987654321",
    "sender_address" => "456 Second Street, Lagos, Nigeria",
    "sender_occupation" => "Manager",
    "transfer_purpose" => "Payment for goods and services"
];
$transfer = Flutterwave::initiateTransfer($transferPayload);
```

## Initiate Bulk Transfer

Initiate a new bulk transfer.

```php
$transferPayload = [
    [
        "bank_code" => "FNB",
        "account_number" => "0031625807099",
        "amount" => 1900,
        "currency" => "ZAR",
        "narration" => "Test transfer to F4B Developers",
        "reference" => "bulk_Transfers_0019_PMCK",
        "meta" => [
            [
                "first_name" => "Wavers",
                "last_name" => "N/A",
                "email" => "hi@flutterwavego.com",
                "mobile_number" => "+23457558595",
                "recipient_address" => "234 Kings road, Cape Town"
            ]
        ]
    ],
    [
        "bank_code" => "FNB",
        "account_number" => "0031625807099",
        "amount" => 3200,
        "currency" => "ZAR",
        "narration" => "Test transfer to Support",
        "reference" => "bulk_Transfers_0020_PMCK",
        "meta" => [
            [
                "first_name" => "Flutterwave",
                "last_name" => "Developers",
                "email" => "developers@flutterwavego.com",
                "mobile_number" => "+23457558595",
                "recipient_address" => "234 Kings road, Cape Town"
            ]
        ]
    ]
];

$transferTitle = 'Test Bulk Transfer';
$transfer = Flutterwave::createBulkTransfer($transferPayload, $transferTitle);
```

## Retry Transfer

Retry a transfer.

```php
$transferId = 200;
$transfer = Flutterwave::retryTransfer($transferId);
```

## Get Transfer Retries

Get retries for a transfer.

```php
$transferId = 200;
$transfer = Flutterwave::getTransferRetry($transferId);
```

## Get Bulk Transfer

Get a bulk transfer.

```php
$transferId = 200;
$transfer = Flutterwave::fetchBulkTransfer($transferId);
```
