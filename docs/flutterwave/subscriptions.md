# Subscription API

## Get All Subscription

Get list of subscription.

```php
$optionalPayload = [
    'email' => 'customer@example.com',
    'transaction_id' => 123456,
    'plan' => 789,
    'subscribed_from' => '2021-01-01',
    'subscribed_to' => '2021-12-31',
    'next_due_from' => '2021-06-01',
    'next_due_to' => '2021-06-30',
    'page' => 1,
    'status' => 'active',
];

$subscriptions = Flutterwave::getAllSubscriptions($optionalPayload);
```

## Activate Subscription

Activate a subscription.

```php
$subscriptionId = 200;
$subscription = Flutterwave::activateSubscription($subscriptionId);
```

## Deactivate Subscription

Deactivate a subscription.

```php
$subscriptionId = 200;
$subscription = Flutterwave::deactivateSubscription($subscriptionId);
```
