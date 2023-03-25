# Setup

In your .env file set the following keys:

```php
STRIPE_BASE_URI=xxxxxxxxxxxxxx
STRIPE_SECRET=xxxxxxxxxxx
STRIPE_WEBHOOK_SECRET=xxxxxxxxxx
STRIPE_CURRENCY=xxxxxxxxx
```

* **STRIPE_BASE_URI -** The api endpoint for stripe i.e https://api.stripe.com/v1

* **STRIPE_SECRET -** This is the access key to the api, can be gotten [here](https://dashboard.stripe.com/account/apikeys)

* **STRIPE_WEBHOOK_SECRET -** This is used to verify webhook requests from stripe, can be gotten [here](https://dashboard.stripe.com/account/webhooks)

* **STRIPE_CURRENCY -** This is the default currency you want to use for your transactions.
