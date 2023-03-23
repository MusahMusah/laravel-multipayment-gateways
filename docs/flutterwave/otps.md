# OTP API

## Create OTP

Create a new OTP.

```php
$payload = [
    'length' => 7,
    'customer' => [
        'name' => 'Flutterwave Developers',
        'email' => 'developers@flutterwavego.com',
        'phone' => '2348000000000',
    ],
    'sender' => 'Flutterwave Inc.',
    'send' => true,
    'medium' => ['sms'],
    'expiry' => 60,
];
$otp = Flutterwave::createOtp($payload);
```

## Verify OTP

Verify an OTP.

```php
$payload = [
    'otp' => 9177301
];
$reference = 'CF-BARTER-20230211040318175863';
$otp = Flutterwave::verifyOtp($reference, $payload);
```
