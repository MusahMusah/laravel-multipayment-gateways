# Bank API

## Get Banks

Get list of banks for a given country by shortcode.

```php
$shortCode = 'NG';
$banks = Flutterwave::getBanks($shortCode);

other shortcodes include: GH, KE, UG, ZA or TZ.
```

## Get Bank Branches

Get list of branches for a given bank.

```php
$bankId = 200;
$bankBranches = Flutterwave::getBankBranches($bankId);
```
