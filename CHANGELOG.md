# Changelog

All notable changes to `laravel-multipayment-gateways` will be documented in this file.

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
