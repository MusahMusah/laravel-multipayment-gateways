# Transaction API

## Handle Transaction
**Stripe Payment** can be handled in similar ways as **Paystack Payment**.
The package allow you to make payment requests using the `facade`, `helper` or `dependency injection`.
1. **Prepare your route to handle the payment request:**
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\StripePaymentController;
    
    Route::post('/payment/stripe', [StripePaymentController::class, 'initiatePayment'])->name('payment.stripe.initiate');
    ```
   
2. **Create a controller to handle the payment request:** In the controller, you can use your desired Payment Gateway to handle the payment request using the **facade**, **helper** or **dependency injection**

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

The `createIntent` method will create a payment intent and return the client secret to be used 
in the frontend to confirm the payment. In addition, the package also provides a method to confirm the payment intent.
You can confirm the payment intent in the following ways:
1. **Prepare your route to handle the payment confirmation request:**
    ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\StripePaymentController;
    
    Route::post('/payment/stripe/confirm', [StripePaymentController::class, 'confirmPayment'])->name('payment.stripe.confirm');
    ```

2. **Create a controller to handle the payment confirmation request using Facade:**
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
