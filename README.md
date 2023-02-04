# A Laravel Package that makes implementation of multiple payment Gateways endpoints and webhooks seamless 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/musahmusah/laravel-multipayment-gateways/run-tests?label=tests)](https://github.com/musahmusah/laravel-multipayment-gateways/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/musahmusah/laravel-multipayment-gateways/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/musahmusah/laravel-multipayment-gateways/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
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

[//]: # (This is the contents of the published config file:)

[//]: # ()
[//]: # (```php)

[//]: # (return [)

[//]: # (    )
[//]: # (];)

[//]: # (```)

## Usage
This package provides various ways to handle payments and webhooks.
The idea is to provide a way to handle payments and webhooks in laravel `web` and `api` based applications.
### Handling Payments
Payment can be handled in the following ways:
1. Using the facade
```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Facades\Stripe;

// Using Paystack Facade
Paystack::getBanks();
Paystack::redirectToCheckout();

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
