# Settlement API

## Get All Settlements

Get list of settlements.

```php
$optionalPayload = [
    'page' => 1,
    'from' => '2023-01-01',
    'to' => '2023-01-31',
    'subaccount_id' => 'xxx',
];

$settlements = Flutterwave::getAllSettlements($optionalPayload);
```

## Get Settlement

Get details of a single settlement.

```php
$settlementId = 200;
$settlement = Flutterwave::getSettlement($settlementId);
```
