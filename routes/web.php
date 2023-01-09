<?php

use Illuminate\Support\Facades\Route;
use MusahMusah\LaravelMultipaymentGateways\Http\Controllers\PaystackWebhookController;
use MusahMusah\LaravelMultipaymentGateways\Http\Controllers\StripeWebhookController;
use MusahMusah\LaravelMultipaymentGateways\Http\Middleware\VerifyPaystackWebhookSignature;
use MusahMusah\LaravelMultipaymentGateways\Http\Middleware\VerifyStripeWebhookSignature;

Route::post('paystack/webhook', PaystackWebhookController::class)
        ->middleware(VerifyPaystackWebhookSignature::class)
        ->name('paystack.webhook');

Route::post('stripe/webhook', StripeWebhookController::class)
    ->middleware(VerifyStripeWebhookSignature::class)
    ->name('stripe.webhook');
