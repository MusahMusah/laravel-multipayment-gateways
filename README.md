# A Laravel Package that makes implementation of multiple payment Gateways endpoints and webhooks seamless 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)
<a href="https://packagist.org/packages/musahmusah/laravel-multipayment-gateways"><img src="https://img.shields.io/packagist/php-v/musahmusah/laravel-multipayment-gateways.svg?style=flat-square" alt="PHP from Packagist"></a>
<a href="https://packagist.org/packages/musahmusah/laravel-multipayment-gateways"><img src="https://img.shields.io/badge/Laravel-8.x,%209.x,%2010.x-brightgreen.svg?style=flat-square" alt="Laravel Version"></a>
![Test Status](https://img.shields.io/github/actions/workflow/status/musahmusah/laravel-multipayment-gateways/run-tests.yml?branch=main&label=Tests)
![Code Style Status](https://img.shields.io/github/actions/workflow/status/musahmusah/laravel-multipayment-gateways/phpstan.yml?branch=main&label=Code%20Style)
[![Total Downloads](https://img.shields.io/packagist/dt/musahmusah/laravel-multipayment-gateways.svg?style=flat-square)](https://packagist.org/packages/musahmusah/laravel-multipayment-gateways)

The `laravel-multipayment-gateways` package provides a convenient way to handle payments through multiple payment gateways in a **Laravel 8, 9 and 10 application**. 
The package currently supports multiple gateways such as **Paystack**, **Flutterwave** and **Stripe**. 
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
    
    'flutterwave' => [
        'base_uri' => env('FLUTTERWAVE_BASE_URI'),
        'secret' => env('FLUTTERWAVE_SECRET'),
        'currency' => env('FLUTTERWAVE_CURRENCY'),
        'encryption_key' => env('FLUTTERWAVE_ENCRYPTION_KEY'),
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

    'webhooks' => [
        [
            /*
             * This refers to the name of the payment gateway being used.
             */
            'name' => 'stripe',

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
```php
PAYSTACK_BASE_URI=https://api.paystack.co
PAYSTACK_SECRET=xxxxxxxxxxxxx
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
- `payment_webhook_event`: The payment_webhook_event option allows you to specify the event class that will be used to process webhook requests for payment methods. This should be set to a class that extends `\MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent` by default the package dispatches the `PaymentWebhookReceivedEvent` event that you can create a listener for. However, you can create your own event class and specify it in the `payment_webhook_event` option.


## Usage
**All payment gateways methods and properties can be accessed using their respective `facade`, `helper` or `dependency injection`.**
This ensures consistency in the way you access the payment gateways.  
The idea is to provide a way to handle payments and webhooks in laravel `web` and `api` based applications.

### Handling Payments with Paystack
Web Payment can be handled in the following ways:
1. Prepare your route to handle the payment request.
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PaymentController;
    
    Route::post('/payment', [PaystackPaymentController::class, 'initiatePayment'])->name('payment.initiate');
    ```

2. Create a controller to handle the payment request. In the controller, you can use your desired `Payment Gateway` to handle the payment request using the `facade`, `helper` or `dependency injection`.  
                                                    
   - Create a controller to handle the payment request using Facade.
     ```php
     use Illuminate\Http\Request;
     use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
    
     class PaystackPaymentController extends Controller
     {
         public function initiatePayment(Request $request)
         {
             $payment = Paystack::redirectToCheckout([
                 'amount' => 1000,
                 'email' => 'musahmusah@test.com',
                 'reference' => '123456789',
                 'callback_url' => 'https://example.com',
             ]);
            
             return $payment;
         }
     }
     ```

   - Create a controller to handle the payment request using Helper.
     ```php
     use Illuminate\Http\Request;
        
     class PaystackPaymentController extends Controller
     {
         public function initiatePayment(Request $request)
         {
             $payment = paystack()->redirectToCheckout([
                 'amount' => 1000,
                 'email' => 'musahmusah@test.com',
                 'reference' => '123456789',
             ]);
            
             return $payment;
         }
     }
     ```
     In the above example, the `redirectToCheckout()` method was called without the parameters 
     `callback_url` in the array. This means you have to add callback url in your paystack dashboard 
     [here](https://dashboard.paystack.com/#/settings/developer) to handle redirect after payment.

   - Create a controller to handle the payment request using Dependency Injection through the `PaystackContract` interface.
     ```php
     use Illuminate\Http\Request;
     use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
    
     class PaystackPaymentController extends Controller
     {
         public function initiatePayment(Request $request, PaystackContract $paystack)
         {
             $payment = $paystack->redirectToCheckout();
            
             return $payment;
         }
     }
     ```
     In the above example, the `PaystackContract` interface was injected into the controller through dependency injection.
     The `redirectToCheckout` method was called without passing any parameters, this is because the package has been configured to use the values from the `request()` object to make the payment request if no parameters are passed to the method.
     This allows you to make payment requests without having to pass any parameters to the method instead you can send the data using hidden inputs in your form or as a json object in your request body.  
     Example of a blade form that can be used to make such a request:
        ```html
         <form action="{{ route('payment.initiate') }}" method="POST">
            @csrf
            <input type="hidden" name="amount" value="1000">
            <input type="hidden" name="email" value="musahmusah@test.com">
            <input type="hidden" name="reference" value="123456789">
            <input type="hidden" name="metadata" value="{{ json_encode(['custom_fields' => ['name' => 'Musah Musah']]) }}"
            <input type="hidden" name="callback_url" value="https://example.com">
            <button type="submit">Pay</button>
         </form>
        ```
     This way when the form is submitted, the `request()` object will be used to extract the data in the hidden inputs inside the `redirectToCheckout` method and make the payment request, allowing you to call the `redirectToCheckout` method without passing any parameters.  
     The `metadata` field is optional, you can add any custom fields you want to the metadata field.   
     Additionally, you need to generate a unique reference for each payment request. You can readmore about paystack payment requests [here](https://developers.paystack.co/reference#initialize-a-transaction)         

3. **Handle the payment response:**  
Upon successful payment, you will be redirected to the `callback_url` that you set in your paystack dashboard or the `callback_url` you passed in the payment request.
    - Add a route to handle the payment response.
        ```php
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\PaymentController;
        
        Route::get('/payment/callback', [PaystackPaymentController::class, 'handlePaymentResponse'])->name('payment.callback');
        ```
    - Create a controller to handle the payment response.
        ```php
        use Illuminate\Http\Request;
        use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
        
        class PaystackPaymentController extends Controller
        {
            public function handlePaymentResponse(Request $request, PaystackContract $paystack)
            {
                $paymentResponse = $paystack->getPaymentData();
                
                // Handle payment response here
            }
        }
        ```

For an api based application where the client is served by a mobile app or on a separate domain, you can use this approach instead:
1. Initialize the payment with the client (mobile app or web app built with react, vue etc) served on a separate domain or port. This can be 
done using the **Paystack Inline Popup** [here](https://paystack.com/docs/payments/accept-payments/#popup).
2. Verify the payment using the `verifyPayment` method provided by the package. This method will verify the payment using the `reference` that has to be passed to the request body.  
   Your route should look like this:
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PaymentController;
    
    Route::post('/payment/verify', [PaystackPaymentController::class, 'verifyPayment'])->name('payment.verify');
    ```
   Your Controller should look like this:
    ```php
    use Illuminate\Http\Request;
    use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
    
    class PaystackPaymentController extends Controller
    {
        public function verifyPayment(Request $request, PaystackContract $paystack)
        {
            $paymentResponse = $paystack->verifyTransaction($request->reference);
            
            if ($paymentResponse->status === 'success') {
                // Handle payment response here
            }
        }
    }
    ```

### Handling Payments with Stripe
**Stripe Payment** can be handled in similar ways as **Paystack Payment**. 
The package allow you to make payment requests using the `facade`, `helper` or `dependency injection`.
1. Prepare your route to handle the payment request.
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\StripePaymentController;
    
    Route::post('/payment/stripe', [StripePaymentController::class, 'initiatePayment'])->name('payment.stripe.initiate');
    ```

2. Create a controller to handle the payment request. In the controller, you can use your desired Payment Gateway to handle the payment request using the **facade**, **helper** or **dependency injection**

    - Create a controller to handle the payment request using Facade.
       ```php
       use Illuminate\Http\Request;
       use MusahMusah\LaravelMultipaymentGateways\Facades\Stripe;
    
       class StripePaymentController extends Controller
       {
           public function initiatePayment(Request $request)
           {
               $payment = Stripe::createIntent([
                   'amount' => 1000,
                   'currency' => 'usd',
                   'payment_method_types' => ['card'],
                   'payment_method' => 'xxxxxxx',
                   'metadata' => ['custom_fields' => ['name' => 'Musah Musah']],
               ]);
            
               return $payment;
           }
       }
       ```
   - Create a controller to handle the payment request using Dependency Injection through the `StripeContract` interface.
       ```php
       use Illuminate\Http\Request;
       use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
    
       class StripePaymentController extends Controller
       {
           public function initiatePayment(Request $request, StripeContract $stripe)
           {
               $payment = $stripe->createIntent([
                   'amount' => 1000,
                   'currency' => 'usd',
                   'payment_method_types' => ['card'],
                   'payment_method' => 'xxxxxxx',
                   'metadata' => ['custom_fields' => ['name' => 'Musah Musah']],
               ]);
            
               return $payment;
           }
       }
       ```

   - Create a controller to handle the payment request using Helper.
       ```php
       use Illuminate\Http\Request;
    
       class StripePaymentController extends Controller
       {
           public function initiatePayment(Request $request)
           {
               $payment = stripe()->createIntent([
                   'amount' => 1000,
                   'currency' => 'usd',
                   'payment_method_types' => ['card'],
                   'payment_method' => 'xxxxxxx',
                   'metadata' => ['custom_fields' => ['name' => 'Musah Musah']],
               ]);
            
               return $payment;
           }
       }
       ```
   
The `createIntent` method will create a payment intent and return the client secret to be used in the frontend to confirm the payment. In addition, the package also provides a method to confirm the payment intent.
You can confirm the payment intent in the following ways:
1. Prepare your route to handle the payment confirmation request.
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\StripePaymentController;
    
    Route::post('/payment/stripe/confirm', [StripePaymentController::class, 'confirmPayment'])->name('payment.stripe.confirm');
    ```

2. Create a controller to handle the payment confirmation request using Facade.
    ```php
    use Illuminate\Http\Request;
    use MusahMusah\LaravelMultipaymentGateways\Facades\Stripe;
    
    class StripePaymentController extends Controller
    {
        public function confirmPayment(Request $request)
        {
            $payment = Stripe::confirmIntent($request->payment_intent_id);
            
            if ($payment->status === 'succeeded') {
                // Payment was successful
            }
            
            return $payment;
        }
    }
    ```
   The `confirmIntent` method will confirm the payment intent and return the payment response. This can also be done using the **helper** or **dependency injection**.

### Handling Webhooks
Webhooks can be handled in the following ways:
1. Prepare your route to handle in-coming webhook request.
    ```php
    use Illuminate\Support\Facades\Route;
    
    Route::webhook('/payment/your-payment-gateway-name', 'your-payment-gateway-name');
    ```

2. Creating a Job Class that extends the `MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob` class
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
    ### **OR** 
    Listening to the `MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceived` event dispatched by the package.
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

3. Performing Webhook Signature Validation:  
   The package provides `\MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator` interface to validate the signature of the in-coming webhook request. 
   You can create your own signature validator class by implementing the `\MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator` interface.
    ```php
    use MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator;
   
    class StripeWebhookSignatureValidator implements PaymentWebhookSignatureValidator
    {
        public function isValid(string $signature, string $payload, string $secret): bool
        {
            // Validate the signature
        }
    }
    ```
    Then, register the signature validator class in the `config/multipayment-gateways.php` file.
    ```php
    'signature_validators' => [
        'stripe' => \App\SignatureValidators\StripeWebhookSignatureValidator::class,
    ],
    ```
   This will ensure that the signature of the in-coming webhook request is valid before the webhook is processed. Allowing you to handle invalid signatures as you wish.

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
