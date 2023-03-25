# Stripe Webhook

By following the instructions below, you can effectively manage stripe webhook events.

## Config Setup

Ensure that this setup is present inside the `multipayment-gateways.php` configuration file

```php
[
    /*
     * This refers to the name of the payment gateway being used.
     */
    'name' => 'stripe',

    /*
     * This secret key is used to validate the signature of the webhook call.
     */
    'signing_secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
     * This refers to the header that holds the signature.
     */
    'signature_header_name' => 'Stripe-Signature',

    /*
     *  This class is responsible for verifying the validity of the signature header.
     *
    * It should implement the interface \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator.
     */
    'signature_validator' => \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\StripeSignatureValidator::class,

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
]
```

## Stripe Signature Validator 
The package ships with a signature validator for stripe which is used as shown below:

```php
'signature_validator' => \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\StripeSignatureValidator::class,
```

## Custom Signature Validator 
To use a custom class for signature validation, create a class that implements the `MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator` interface. Then ensure to update the stripe webhook config to use your custom class as illustrated below.

```php
'signature_validator' => YourCustomSignatureValidator::class,
```

## Disabling Signature Validation
In case you opt not to validate stripe webhook events, you can use the default signature validation class as demonstrated below.

```php
'signature_validator' => \MusahMusah\LaravelMultipaymentGateways\SignatureValidator\DefaultSignatureValidator::class,
```

## Webhook Handler

This refers to the approach you wish to adopt for processing the webhook event, either by dispatching a job or an event. By default, we have set the configuration to use a job.

If you prefer to use an event, you can update it following the example provided below.

```php
'payment_webhook_handler' => 'event',
```

## Handle Webhook Using Job
To manage stripe webhook events using `job`, create a job class that extends the `MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob` class, and modify the configuration as illustrated below:

```php
'payment_webhook_job' => YourCustomStripeWebhookJob::class,
```

Sample Usage:

```php
use MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob;

class YourCustomStripeWebhookJob extends ProcessPaymentWebhookJob implements ShouldQueue
{
    public function handle()
    {
        // Get the webhook data
        $webhookData = $this->webhookPayload;
        
        // Handle the webhook
    }
}
```

## Handle Webhook Using Event
To manage stripe webhook events using `event`, you need to create a listener class that listens to the `MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceived` event triggered by the package. Then, you should adjust the configuration settings as shown below:

```php
'payment_webhook_event' => '\MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent',
```

Register the event listener in the `EventServiceProvider` class.

```php
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
use App\Listeners\YourCustomStripeWebhookListener;

protected $listen = [
    PaymentWebhookReceivedEvent::class => [
        YourCustomStripeWebhookListener::class,
    ],
];
```

Sample Usage:

```php
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
class YourCustomStripeWebhookListener
{
    public function handle(PaymentWebhookReceivedEvent $event)
    {
        // Get the webhook data
        $webhookData = $event->webhookPayload;
      
        // Handle the webhook
    }
}
```

## Route Setup
To include the stripe webhook route, follow the example below and add the route to your `api.php` file:

```php
use Illuminate\Support\Facades\Route;

Route::webhooks('/stripe/webhook', 'stripe');
```
