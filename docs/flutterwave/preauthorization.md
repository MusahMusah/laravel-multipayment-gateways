# Preauthorization API

## Create Charge

Create a preauth charge.

```php
    $payload = [
        "card_number" => "*****",
        "cvv" => "157",
        "expiry_month" => "5",
        "expiry_year" => "22",
        "amount" => "20000",
        "fullname" => "Flutterwave Developers",
        "tx_ref" => "sample-ref",
        "currency" => "NGN",
        "country" => "NG",
        "email" => "developers@flutterwavego.com",
        "redirect_url" => "https://www.flutterwave.com/ng/",
        "preauthorize" => true,
        "meta" => [
            "customer_id" => "200"
        ]
    ];

$transaction = Flutterwave::initiateCardCharge($payload);
```

## Capture a Charge

Capture the payment of an existing but uncaptured charge.

```php
$transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';
$payload = [
    "amount" => "100",
];
$transaction = Flutterwave::captureCharge($transactionRef, $payload);
```

## Void a Charge

Voids the payment of a captured charge.

```php
$transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';
$transaction = Flutterwave::voidCharge($transactionRef);
```

## Create a Refund

Create refund for a charge.

```php
$transactionRef = 'FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101';
$payload = [
    "amount" => "100",
];
$transaction = Flutterwave::createRefund($transactionRef, $payload);
```

## Capture a Paypal Charge

Capture the payment of a previously uncaptured PayPal charge.

```php
$payload = [
    "flw_ref" => "FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101",
];
$transaction = Flutterwave::capturePaypalCharge($payload);
```

## Void a Paypal Charge

Voids the payment of a captured paypal charge.

```php
$payload = [
    "flw_ref" => "FLW-MOCK-PREAUTH-72544a3c7659bcd74cc3a3110fe95101",
];
$transaction = Flutterwave::voidPaypalCharge($payload);
```
