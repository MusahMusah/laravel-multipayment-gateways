# Transaction API

## Get All Transactions

Get list of transactions.

```php
$optionalPayload = [
    'page' => 2,
    'from' => '2021-12-31',
    'to' => '2021-06-01',
];
$transactions = Flutterwave::getTransactions($optionalPayload);
```

## Get Multiple Refund Transactions

Get multiple list of refund transactions.

```php
$optionalPayload = [
    'page' => 2,
    'from' => '2021-12-31',
    'to' => '2021-06-01',
];
$transactions = Flutterwave::getRefundTransactions($optionalPayload);
```

## Get Refund Details

Get details of a refund transaction

```php
$refundId = 200;
$refund = Flutterwave::getRefundDetails($refundId);
```

## Verify Transaction 

Verify a transaction.

```php
$transactionId = 200;
$transaction = Flutterwave::verifyTransaction($transactionId);
```

## Create Transaction Refund

Initiate refund for a transaction.

```php
$transactionId = 200;
$refund = Flutterwave::createTransactionRefund($transactionId);
```

## View Transaction Timeline

Get the timeline of a transaction

```php
$transactionId = 200;
$timeline = Flutterwave::viewTransactionTimeline($transactionId);
```

## Resend Failed Webhook

Resend a failed webhook

```php
$transactionId = 200;
$optionalPayload = [
    'wait' => 1,
];

$webhook = Flutterwave::resendFailedWebhook($transactionId, $optionalPayload);
```

## Get Transactions Fee

Get list of transactions fees.

```php
$payload = [
    'amount' => 20000,
    'currency' => 'NGN'
];
$transactionFee = Flutterwave::getTransactionFee($payload);
```
