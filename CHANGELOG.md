# Changelog

All notable changes to `laravel-multipayment-gateways` will be documented in this file.

## 1.6.5 - 2023-04-22

### What's Changed

- Fixed issues with static analysis failing by @MusahMusah
- Added automated tests for flutterwave service endpoints by @cybernerdie in #10

### New Contributor

- @Adams-Ijachi  made their first contribution to the package in #9 which added better coverage to the httpClient Wrapper

## 1.6.3 - 2023-04-13

### What's Changed

- Updated documentation on how to use the newly added `HttpClientWrapper` with any of the Payment Gateways.
- Added all httpClient methods to individual Payment Gateways Service, this will help IDEs better understand the underlying method signature and structure.

## 1.6.0 - 2023-04-02

### What's Changed

- Added flutterwave gateway helper to ease usage of all the functionalities available in the flutterwave class.

```php
 flutterwave->anymethod();



```
- Optimized codebase with significant refactor

#### Significant Improvement

Added a `HttpClientWrapper` to enable making http `get, post, put, patch and delete` request using dependencies of the desired payment gateways in making such request.
All requests made through the `HttpClientWrapper` will have access to desired gateway `base url`, `secret key` among other dependencies. This change would allow extending the package beyond methods available in a specific gateway class, simply by calling any endpoint from your desired payment gateway api docs with parameters required to make the request should do.
In addition, the `HttpClientWrapper` is available via `helpers`, `dependency injection` and the `facade` of all payment gateways supported.

##### Usage

```php
   // Example of making http get request
   paystack()->httpClient()->get('bank');

   // Example of making http post request
   $fields = [
    "email" => "customer@email.com",
     "first_name" => "Zero",
     "last_name" => "Sum",
    "phone" => "+2348123456789"
   ];
   paystack()->httpClient()->post('customer', $fields);

 // all payment gateways provided by the package can use the httpClient
 Flutterwave::httpClient()->get('/banks/056');
 stripe()->httpClient()->get('v1/customers/cus_4QFOF3xrvBT2nU');



```
## 1.2.5 - 2023-03-26

### What's Changed

- New documentation page added by @cybernerdie
- Add custom webhook signature validation by @MusahMusah
- Additional transaction methods for Paystack Gateway

## 1.2.0 - 2023-02-20

### What's Changed

- Add Support for Flutterwave Gateway by @cybernerdie in #6

## 1.1.0 - 2023-02-18

### What's Changed

- Add Laravel 8 and 10 Support by @MusahMusah in #5
- Add BaseGateway Abstract class to encapsulate commonalities among payment gateways

## Payment Gateways Usage Flow  - 2023-02-04

### Payment Gateways Usage Flow

This release marks the first stable and ready to use version, it contains details on how to use the package to handle payments and webhook in multiple ways.

## Payment Gateways and Webhooks Integration - 2023-02-01

### Payment Gateways Added

- Paystack
- Stripe
- This release incorporates implementations of various endpoints for payment using `paystack` or `stripe`

### Webhooks Integration

The package provides two ways in handling webhooks.

- Job
- Event
- By default webhook request will be handled using default package event handler, However, when passed an event class in the config the class will be used. This behaviour is the same when using job as webhook handler.
