# Setup

In your .env file set the following keys:

```php
FLUTTERWAVE_BASE_URI=xxxxxxxxxxxxxx
FLUTTERWAVE_SECRET=xxxxxxxxxxx
FLUTTERWAVE_ENCRYPTION_KEY=xxxxxxxxxx
FLUTTERWAVE_SECRET_HASH=xxxxxxxxx
```

* **FLUTTERWAVE_BASE_URI -** The api endpoint for flutterwave i.e https://api.flutterwave.com/v3

* **FLUTTERWAVE_SECRET -** This is the access key to the api, can be gotten [here](https://app.flutterwave.com/dashboard/settings/apis/live)

* **FLUTTERWAVE_ENCRYPTION_KEY -** This is used for encypting payload for flutterwave charge api, can be gotten [here](https://app.flutterwave.com/dashboard/settings/apis/live)

* **FLUTTERWAVE_SECRET_HASH -** This is used to verify webhook requests from flutterwave, can be gotten [here](https://app.flutterwave.com/dashboard/settings/webhooks/live)
