# Transfer Beneficiary API

## Get All Transfer Beneficiaries

Get list of transfer beneficiaries.

```php
$optionalPayload = [
   'page' => 2,
];
$beneficiaries = Flutterwave::getAllTransferBeneficiaries($optionalPayload);
```

## Get Transfer Beneficiary

Get details of a single transfer beneficiary.

```php
$beneficiaryId = 200;
$beneficiary = Flutterwave::getTransferBeneficiary($beneficiaryId);
```

## Create Transfer Beneficiary

Create a new transfer beneficiary.

```php
$beneficiaryPayload = [
    'account_bank' => '044',
    'account_number' => '0690000032',
    'beneficiary_name' => 'Flutterwave Developers',
    'currency' => 'NGN',
    'bank_name' => 'Beneficiary Bank'
];
$beneficiary = Flutterwave::createTransferBeneficiary($beneficiaryPayload);
```

## Delete Transfer Beneficiary

Delete a transfer beneficiary.

```php
$beneficiaryId = 200;
$beneficiary = Flutterwave::deleteTransferBeneficiary($beneficiaryId);
```
