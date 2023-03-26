# Transaction API

## Get All Transactions

Get list of transactions.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$optionalPayload = [
    'perPage' => 50,
    'page' => 2,
    'from' => '2021-12-31',
    'to' => '2021-06-01',
];

// Using the facade
$transactions = Paystack::getAllTransactions($optionalPayload);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transactions = $paystack->getAllTransactions($optionalPayload);
}

// Using the helper function
$transactions = paystack()->getAllTransactions($optionalPayload);

```

## Get Transaction

Get a single transaction.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transactionId = "TRX_1234567890";

// Using the facade
$transactions = Paystack::getTransaction($transactionId);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transactions = $paystack->getTransaction($transactionId);
}

// Using the helper function
$transactions = paystack()->getTransaction($transactionId);

```

## Verify Transaction 

Verify a transaction.

```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

$transactionId = "Trx_1234567890";

// Using the facade
$transaction = Paystack::verifyTransaction($transactionId);

// Using Dependency Injection
public function index(PaystackContract $paystack)
{
    $transaction = $paystack->verifyTransaction($transactionId);
}

// Using the helper function
$transaction = paystack()->verifyTransaction($transactionId);

```


## Handle Transaction
Web Payment can be handled in the following ways:
1. **Prepare your route to handle the payment request:**
   ```php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\PaystackPaymentController;

    Route::post('/payment', [PaystackPaymentController::class, 'initiatePayment'])->name('payment.initiate');
    ```
   
2. **Create a controller to handle the payment request:** In the controller, you can use your desired `Payment Gateway` to handle the payment request using the `facade`, `helper` or `dependency injection`.
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
      The `redirectToCheckout` method was called without passing any parameters, this is because the package has been configured 
      to use the values from the `request()` object to make the payment request if no parameters are passed to the method.
      This allows you to make payment requests without having to pass any parameters to the method instead you can send the data 
      using hidden inputs in your form or as a json object in your request body.  
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
      use App\Http\Controllers\PaystackPaymentController;
    
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
   
