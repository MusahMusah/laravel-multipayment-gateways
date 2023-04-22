# Making Request to Other Endpoints
Given that our `Flutterwave` service only provide access to the most common endpoints, you can make request to other endpoints
we have not added to the service by using the `HttpClientWrapper` class. This class is a wrapper around the `GuzzleHttp\Client`
class and it provides a simple way to make request to any endpoint. The `HttpClientWrapper` class is available through the 
`Flutterwave` facade, `flutterwave()` helper or through dependency injection using the `FlutterwaveContract` interface.
The `HttpClientWrapper` class, is designed to extract some of the configurations from the `Flutterwave` service so you
that you don't have to pass them when making request to other endpoints.

# You can use the `HttpClientWrapper` class in any of the following ways:
## Using Facade
```php
use MusahMusah\LaravelMultipaymentGateways\Facades\Flutterwave;

// Example of making get request 
$response = Flutterwave::httpClient()->get('/banks/056');
dd($response);

```

## Using Helper
```php

 // this will make a get request to the endpoint https://api.flutterwave.com/banks/056
 $response = flutterwave()->httpClient()->get('/banks/056');
 dd($response);

```

## Using Dependency Injection
```php
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;

class FlutterwavePaymentController extends Controller
{
    public function initiatePayment(Request $request, FlutterwaveContract $flutterwave)
    {
        // this will make a get request to the endpoint https://api.flutterwave.com/banks/056
        $response = $flutterwave->httpClient()->get('/banks/056');
        dd($response);
    }
}

```

With the above example, you can make request to any `Flutterwave` endpoint you want. This ensures the package is flexible and can be used
to make request to any endpoint of the payment gateway you are using.

# All HTTP Methods Available
The `HttpClientWrapper` class provides access to all the HTTP methods available in the `GuzzleHttp\Client` class. The methods are:
- `get`
- `post`
- `put`
- `patch`
- `delete`
