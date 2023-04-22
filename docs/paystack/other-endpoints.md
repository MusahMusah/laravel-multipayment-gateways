# Making Request to Other Endpoints
Given that our `Paystack` service only provide access to the most common endpoints, you can make request to other endpoints
we have not added to the service by using the `HttpClientWrapper` class. This class is a wrapper around the `GuzzleHttp\Client`
class and it provides a simple way to make request to any endpoint. The `HttpClientWrapper` class is available through the 
`Paystack` facade, `paystack()` helper or through dependency injection using the `PaystackContract` interface.
The `HttpClientWrapper` class, is designed to extract some of the configurations from the `Paystack` service so you 
that you don't have to pass them when making request to other endpoints.

# You can use the `HttpClientWrapper` class in any of the following ways:
## Using Facade
```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Paystack;

// Example of making http post request
 $fields = [
    "email" => "customer@email.com",
     "first_name" => "Zero",
     "last_name" => "Sum",
    "phone" => "+2348123456789"
 ];
 
 // this will make a post request to https://api.paystack.co/customer as get request
$response = Paystack::httpClient()->post('customer', $fields);
dd($response);

```

## Using Helper
```php
// Example of making http post request
  $fields = [
    "email" => "customer@email.com",
     "first_name" => "Zero",
     "last_name" => "Sum",
    "phone" => "+2348123456789"
 ];

// this will make a post request to https://api.paystack.co/customer as post request
 $response = paystack()->httpClient()->post('customer', $fields);
 dd()

```

## Using Dependency Injection
```php
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;

class PaystackPaymentController extends Controller
{
    public function initiatePayment(Request $request, PaystackContract $paystack)
    {
        // Example of making http post request
        $fields = [
            "email" => "customer@email.com",
             "first_name" => "Zero",
             "last_name" => "Sum",
            "phone" => "+2348123456789"
        ];
        // this will make a post request to https://api.paystack.co/customer as post request
        $response = $paystack->httpClient()->post('customer', $fields);
    }
}

```

With the above example, you can make request to any `Paystack` endpoint you want. This ensures the package is flexible and can be used
to make request to any endpoint of the payment gateway you are using.

# All HTTP Methods Available
The `HttpClientWrapper` class provides access to all the HTTP methods available in the `GuzzleHttp\Client` class. The methods are:
- `get`
- `post`
- `put`
- `patch`
- `delete`
