# Making Request to Other Endpoints
Given that our `Stripe` service only provide access to the most common endpoints, you can make request to other endpoints
we have not added to the service by using the `HttpClientWrapper` class. This class is a wrapper around the `GuzzleHttp\Client`
class and it provides a simple way to make request to any endpoint. The `HttpClientWrapper` class is available through the 
`Stripe` facade, `stripe()` helper or through dependency injection using the `StripeContract` interface.
The `HttpClientWrapper` class, is designed to extract some of the configurations from the `Stripe` service so you
that you don't have to pass them when making request to other endpoints.

# You can use the `HttpClientWrapper` class in any of the following ways:
## Using Facade
```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Stripe;

// This will make a request to the endpoint: https://api.stripe.com/v1/customers/cus_4QFOF3xrvBT2nU as a get request
$response = Stripe::httpClient()->get('v1/customers/cus_4QFOF3xrvBT2nU');
dd($response);

```

## Using Helper
```php

 // this will make a request to the endpoint: https://api.stripe.com/v1/customers/cus_4QFOF3xrvBT2nU as a get request
 $response = stripe()->httpClient()->get('v1/customers/cus_4QFOF3xrvBT2nU');
 dd($response);

```

## Using Dependency Injection
```php
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;

class StripePaymentController extends Controller
{
    public function initiatePayment(Request $request, StripeContract $stripe)
    {
        // this will make a request to the endpoint: https://api.stripe.com/v1/customers/cus_4QFOF3xrvBT2nU as a get request
        $response = $stripe->httpClient()->get('v1/customers/cus_4QFOF3xrvBT2nU');
        dd($response);
    }
}

```

With the above example, you can make request to any `Stripe` endpoint you want. This ensures the package is flexible and can be used
to make request to any endpoint of the payment gateway you are using.

# All HTTP Methods Available
The `HttpClientWrapper` class provides access to all the HTTP methods available in the `GuzzleHttp\Client` class. The methods are:
- `get`
- `post`
- `put`
- `patch`
- `delete`
