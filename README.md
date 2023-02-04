# A Laravel Package that makes implementation of multiple payment Gateways endpoints and webhooks seamless 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)
![Test Status](https://img.shields.io/github/actions/workflow/status/musahmusah/laravel-multipayment-gateways/run-tests.yml?branch=main&label=Tests)
![Code Style Status](https://img.shields.io/github/actions/workflow/status/musahmusah/laravel-multipayment-gateways/phpstan.yml?branch=main&label=Code%20Style)
[![Total Downloads](https://img.shields.io/packagist/dt/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)

The `laravel-multipayment-gateways` package provides a convenient way to handle payments through multiple payment gateways in a Laravel application. 
The package currently supports multiple gateways such as Paystack and Stripe. 
The package offers an easy to use interface that abstracts the complexities of integrating with these payment gateways. 
It also provides a way to handle webhooks from the payment gateways.

## Installation

You can install the package via composer:

```bash
composer require musahmusah/laravel-multipayment-gateways
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="multipayment-gateways-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="multipayment-gateways-config"
```

This is the contents of the published config file:

```php

return [
    'paystack' => [
        'base_uri' => env('PAYSTACK_BASE_URI'),
        'secret' => env('PAYSTACK_SECRET'),
        'currency' => env('PAYSTACK_CURRENCY'),
    ],

    'stripe' => [
        'base_uri' => env('STRIPE_BASE_URI'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        'currency' => env('STRIPE_CURRENCY'),
        'plans' => [
            'monthly' => env('STRIPE_MONTHLY_PLAN'),
            'yearly' => env('STRIPE_YEARLY_PLAN'),
        ],
    ],

    'configs' => [
        [
            /*
             * This refers to the name of the payment gateway being used.
             */
            'name' => 'default',

            /*
             * This secret key is used to validate the signature of the webhook call.
             */
            'signing_secret' => '',

            /*
             * This refers to the header that holds the signature.
             */
            'signature_header_name' => 'Stripe-Signature',

            /*
             *  This class is responsible for verifying the validity of the signature header.
             *
             * It should implement the interface \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator.
             */
            'signature_validator' => \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\DefaultSignatureValidator::class,

            /**
             * The webhook handler option allows you to choose how webhook requests are handled in your application.
             *
             * Available options:
             * - 'job': Webhook requests will be handled by a job.
             * - 'event': Webhook requests will be handled by an event.
             *
             * Default: 'job'
             */
            'payment_webhook_handler' => 'job',

            /**
             * The payment_webhook_job option allows you to specify the job class that will be used to process webhook requests for payment methods.
             *
             * This should be set to a class that extends \MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob.
             */
            'payment_webhook_job' => '',

            /**
             * The payment_webhook_event option allows you to specify the event class that will be used to process webhook requests for payment methods.
             *
             * This should be set to a class that extends \MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent.
             */
            'payment_webhook_event' => '',
        ],

        [
            /*
             * This refers to the name of the payment gateway being used.
             */
            'name' => 'paystack',

            /*
             * This secret key is used to validate the signature of the webhook call.
             */
            'signing_secret' => '',

            /*
             * This refers to the header that holds the signature.
             */
            'signature_header_name' => 'Paystack-Signature',

            /*
             *  This class is responsible for verifying the validity of the signature header.
             *
            * It should implement the interface \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator.
             */
            'signature_validator' => \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\DefaultSignatureValidator::class,

            /**
             * The webhook handler option allows you to choose how webhook requests are handled in your application.
             *
             * Available options:
             * - 'job': Webhook requests will be handled by a job.
             * - 'event': Webhook requests will be handled by an event.
             *
             * Default: 'job'
             */
            'payment_webhook_handler' => 'event',

            /**
             * The payment_webhook_job option allows you to specify the job class that will be used to process webhook requests for payment methods.
             *
             * This should be set to a class that extends \MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob.
             */
            'payment_webhook_job' => '',

            /**
             * The payment_webhook_event option allows you to specify the event class that will be used to process webhook requests for payment methods.
             *
             * This should be set to a class that extends \MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent.
             */
            'payment_webhook_event' => '',
        ],
    ],
];

```
To prepare your application to handle payments using any of the payment gateways, you need to add the values to your `.env` file.
Each payment gateway has its own set of values that you need to add to your `.env` file as documented in the config file above.
For example, to use the `paystack` payment gateway, you need to add the following values to your `.env` file:
```dotenv
PAYSTACK_BASE_URI=https://api.paystack.co
PAYSTACK_SECRET=sk_test_123456789
PAYSTACK_CURRENCY=NGN
```
To prepare your application to handle webhooks for any of the payment gateways, you need to update the `configs` array in the `config/multipayment_gateways.php` file generated by the package.
Each payment gateway has to be configured with the following values:
- `name`: This refers to the name of the payment gateway being used.
- `signing_secret`: This secret key is used to validate the signature of the webhook call.
- `signature_header_name`: This refers to the header that holds the signature.
- `signature_validator`: This class is responsible for verifying the validity of the signature header. It should implement the interface `\MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator`.
- `payment_webhook_handler`: The webhook handler option allows you to choose how webhook requests are handled in your application. Available options are:
    - `job`: Webhook requests will be handled by a job.
    - `event`: Webhook requests will be handled by an event.
    - Default: `job`
- `payment_webhook_job`: The payment_webhook_job option allows you to specify the job class that will be used to process webhook requests for payment methods. This should be set to a class that extends `\MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob`.
- `payment_webhook_event`: The payment_webhook_event option allows you to specify the event class that will be used to process webhook requests for payment methods. This should be set to a class that extends `\MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent` by default the package provides a default event class that you can create a listener for.


## Usage
This package provides various ways to handle payments and webhooks.
The idea is to provide a way to handle payments and webhooks in laravel `web` and `api` based applications.
### Handling Payments
Payment can be handled in the following ways:
#### Using the Facade
```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Facades\Stripe;

// Using Paystack Facade for web applications
Paystack::redirectToCheckout([
    'amount' => 1000,
    'email' => 'musahmusah@test.com',
    'reference' => '123456789',
    'callback_url' => 'https://example.com',
]);

// Using Stripe Facade
Stripe::createIntent();
Stripe::confirmIntent();
```
2. Using Dependency Injection with the PaymentGateways Interface
```php
use Illuminate\Support\Facades\Route;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;

// Using Paystack Contract
Route::get('/paystack/banks', function (PaystackContract $paystack) {
    return $paystack->getBanks();
});

// Using Stripe Contract
Route::get('/stripe/create-intent', function (StripeContract $stripe) {
    return $stripe->createIntent();
});
```

3. Using Helper Functions
```php
// Using Paystack Helper
paystack()->getBanks();
paystack()->redirectToCheckout();

// Using Stripe Helper
stripe()->createIntent();
stripe()->confirmIntent();

```

### Handling Webhooks
Webhooks can be handled in the following ways:
1. Creating a Job Class that extends the `MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob` class
```php
use MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob;

class PaymentWebhookJob extends ProcessPaymentWebhookJob implements ShouldQueue
{
    public function handle()
    {
        // Get the webhook data
        $webhookData = $this->webhookPayload;
        
        // Handle the webhook
    }
}
```
2. Listening to the `MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceived` event dispatched by the package.
* Create an event listener class that will listen to the `MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceived` event.
```php
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
class PaymentWebhookListener
{
    public function handle(PaymentWebhookReceivedEvent $event)
    {
        // Get the webhook data
        $webhookData = $event->webhookPayload;
        
        // Handle the webhook
    }
}
```
* Register the event listener in the `EventServiceProvider` class.
```php
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
use App\Listeners\PaymentWebhookListener;

protected $listen = [
    PaymentWebhookReceivedEvent::class => [
        PaymentWebhookListener::class,
    ],
];
```

## Testing

```bash
php artisan test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [MusahMusah](https://github.com/MusahMusah)
- [Cybernerdie](https://github.com/cybernerdie)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
