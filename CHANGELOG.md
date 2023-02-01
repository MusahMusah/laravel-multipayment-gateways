# Changelog

All notable changes to `laravel-multipayment-gateways` will be documented in this file.

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
