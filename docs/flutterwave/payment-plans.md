# Payment Plan API

## Get All Payment Plans

Get list of settlements.

```php
$optionalPayload = [
   'from' => '2021-01-01',
   'to' => '2021-12-31',
   'page' => 2,
   'amount' => 1000,
   'currency' => 'NGN',
   'interval' => 'weekly',
   'status' => 'active',
];
$paymentPlans = Flutterwave::getAllPaymentPlans($optionalPayload);
```

## Get Payment Plan

Get details of a single payment plan.

```php
$planId = 200;
$paymentPlan = Flutterwave::getPaymentPlan($planId);
```

## Create Payment Plan

Create a new payment plan.

```php
$planPayload = [
    'amount' => 10000,
    'name' => "Test Plan",
    'interval' => 'daily'
];
$paymentPlan = Flutterwave::createPaymentPlan($planPayload);
```

## Update Payment Plan

Update a payment plan.

```php
$planId = 200;
$planPayload = [
    'name' => "Test Plan",
    'status' => 'active'
];
$paymentPlan = Flutterwave::updatePaymentPlan($planId, $planPayload);
```

## Cancel Payment Plan

Cancel a payment plan.

```php
$planId = 200;
$paymentPlan = Flutterwave::cancelPaymentPlan($planId);
```
