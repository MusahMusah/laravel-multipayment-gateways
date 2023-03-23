# Charge API

## Charge Card

Initiate a card charge.

```php
$payload = [
    "card_number" => "5531886652142950",
    "cvv" => "564",
    "expiry_month" => "09",
    "expiry_year" => "32",
    "currency" => "NGN",
    "amount" => "100",
    "fullname" => "Yolande Aglaé Colbert",
    "email" => "stefan.wexler@hotmail.eu",
    "tx_ref" => "MC-3243e",
    "redirect_url" => "https://www.flutterwave.ng",
    "meta":{
        "customer_id":"200"
    }
];

$transaction = Flutterwave::initiateCardCharge($payload);
```

## Bank Transfer

Initiate a bank tranfer.

```php
$payload = [
    "tx_ref" => "ref0021",
    "amount" => "100",
    "email" => "stefan.wexler@hotmail.eu",
    "phone_number" => "08000000000",
    "currency" => "NGN",
    "client_ip" => "154.123.220.1",
    "device_fingerprint" => "62wd23423rq324323qew1",
    "narration" => "FlW Devs",
    "is_permanent" => false,
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::initiateBankTransfer($payload);
```

## Charge Nigerian Bank Account

Initiate charge for a nigerian bank account.

```php
$payload = [
    "tx_ref" => "MC-1585230ew9v5050e8",
    "amount" => "100",
    "account_bank" => "044",
    "account_number" => "0690000032",
    "currency" => "NGN",
    "email" => "stefan.wexler@hotmail.eu",
    "phone_number" => "0902620185",
    "fullname" => "Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeNigerianBankAccount($payload);
```

## Charge MPESA

Collect Mpesa Payment for Kenyan customers.

```php
$payload = [
    "tx_ref":"MC-15852113s09v5050e8",
    "amount":"10",
    "currency":"KES",
    "email":"user@example.com",
    "phone_number":"25454709929220",
    "fullname":"Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeMpesa($payload);
```

## Charge Ghana Mobile Money

Collect mobile money payments for Ghanian customers.

```php
$payload = [
    "tx_ref":"MC-158523s09v5050e8",
    "amount":"150",
    "currency":"GHS",
    "voucher":"143256743",
    "network":"MTN",
    "email":"user@example.com",
    "phone_number":"054709929220",
    "fullname":"Yolande Aglaé Colbert",
    "client_ip":"154.123.220.1",
    "device_fingerprint":"62wd23423rq324323qew1",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeGhanaMobileMoney($payload);
```

## Charge Uganda Mobile Money

Collect mobile money payments for Ugandan customers.

```php
$payload = [
    "tx_ref":"MC-158523s09v5050e8",
    "amount":"150",
    "currency":"UGX",
    "voucher":"128373",
    "network":"VODAFONE",
    "email":"user@example.com",
    "phone_number":"054709929220",
    "fullname":"Yolande Aglaé Colbert",
    "client_ip":"154.123.220.1",
    "device_fingerprint":"62wd23423rq324323qew1",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeUgandaMobileMoney($payload);
```

## Charge Francophone Mobile Money

Collect mobile money payments for customers in francophone countries.

```php
$payload = [
    "tx_ref":"MC-158523s09v5050e8",
    "amount":"10",
    "currency":"XAF",
    "country": "CM",
    "email":"user@example.com",
    "phone_number":"23700000020",
    "fullname":"Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeMobileMoneyFranco($payload);
```

## Charge Rwanda Mobile Money

Collect mobile money payments for Rwandan customers.

```php
$payload = [
    "tx_ref":"MC-158523s09v5050e8",
    "order_id":"USS_URG_893982923s2323",
    "amount":"10",
    "currency":"RWF",
    "email":"user@example.com",
    "phone_number":"054709929220",
    "fullname":"Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeMobileMoneyRwanda($payload);
```

## Charge USSD

Collect USSD payments for Nigerian customers.

```php
$payload = [
    "tx_ref": "MC-15852309v5050e8y",
    "account_bank": "057",
    "amount": "10",
    "currency": "NGN",
    "email": "user@example.com",
    "phone_number": "054709929220",
    "fullname": "Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeUssd($payload);
```

## Charge UK Bank Account

Initiate charge for a UK bank account.

```php
$payload = [
    "tx_ref" => "MC-1585230ew9v5050e8",
    "amount" => "100",
    "account_bank" => "044",
    "account_number" => "0690000032",
    "currency" => "GBP",
    "email" => "stefan.wexler@hotmail.eu",
    "phone_number" => "0902620185",
    "fullname" => "Yolande Aglaé Colbert",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeUkBankAccount($payload);
```

## ACH Payments

Collect ACH payments for USD and ZAR transactions.

```php
$payload = [
    "tx_ref": "MC-1585230ew9v5050e8",
    "amount": "100",
    "currency": "USD",
    "country": "US",
    "email": "user@example.com",
    "phone_number": "0902620185",
    "fullname": "Yolande Aglaé Colbert",
    "client_ip": "154.123.220.1",
    "redirect_url": "https://www.flutterwave.com/us/",
    "device_fingerprint": "62wd23423rq324323qew1",
     "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeAchPayment($payload);
```

## Apple Pay

Accept payments from your customers with Apple Pay.

```php
$payload = [
    "tx_ref":"MC-TEST-123456",
    "amount":"10",
    "currency":"USD",
    "email": "user@example.com",
    "fullname": "Yolande Aglaé Colbert",
    "narration":"Test payment",
    "redirect_url":"http://localhost:9000/dump",
    "client_ip":"192.168.0.1",
    "device_fingerprint":"gdgdhdh738bhshsjs",
    "billing_zip":"15101",
    "billing_city":"allison park",
    "billing_address":"3563 Huntertown Rd",
    "billing_state":"Pennsylvania",
    "billing_country":"US",
    "phone_number":"09012345678",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeApplePay($payload);
```

## Google Pay

Accept payments from your customers with Google Pay.

```php
$payload = [
    "tx_ref": "MC-TEST-1234568_success_mock",
    "amount": "10",
    "currency": "USD",
    "email": "user@example.com",
    "fullname": "Yolande Aglaé Colbert",
    "narration": "Test Google Pay charge",
    "redirect_url": "http://localhost:9000/dump",
    "client_ip": "192.168.0.1",
    "device_fingerprint": "gdgdhdh738bhshsjs",
    "billing_zip": "15101",
    "billing_city": "allison park",
    "billing_address": "3563 Huntertown Rd",
    "billing_state": "Pennsylvania",
    "billing_country": "US",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeGooglePay($payload);
```

## Fawry Pay

Accept payments from your customers with Fawry Pay.

```php
$payload = [
    "tx_ref": "fawrySample1",
    "amount": "10",
    "email": "user@flw.com",
    "currency": "EGP",
    "phone_number": "09012345678",
    "redirect_url": "https://www.flutterwave.com",
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargeFawryPay($payload);
```

## Paypal Pay

Accept payments from your customers with Paypal.

```php
$payload = [
    "tx_ref": "PayPalv3Test03",
    "amount": "10",
    "currency": "USD",
    "country": "US",
    "email": "dovedom221@vss6.com",
    "phone_number": "054222234847",
    "fullname": "John Madakin",
    "client_ip": "154.123.220.1",
    "redirect_url": "http://johnmadakin.com/u/payment-completed",
    "device_fingerprint": "62wd23423rq324323qew1",
    "billing_address": "3563 Huntertown Rd",
    "billing_city": "Allison park",
    "billing_zip": "15101",
    "billing_state": "Pensylvannia",
    "billing_country": "US",
    "shipping_name": "Robert K Gagne",
    "shipping_address": "1010  Woodrow Way",
    "shipping_city": "Lufkin",
    "shipping_zip": "75904",
    "shipping_state": "Texas",
    "shipping_country": "US"
    "meta":{
        "customer_id":"200"
    }
];
$transaction = Flutterwave::chargePaypal($payload);
```

## Validate Charge

Validate a charge.

```php
$payload = [
    "otp": "123456",
    "flw_ref": "FLW275407301",
    "type": "card"
];
$transaction = Flutterwave::validateCharge($payload);
```
