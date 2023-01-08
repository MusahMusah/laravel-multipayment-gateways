<?php

use Illuminate\Support\Facades\Route;
use MusahMusah\LaravelMultipaymentGateways\Http\Controllers\PaystackWebhookController;
use MusahMusah\LaravelMultipaymentGateways\Http\Middleware\VerifyPaystackWebhookSignature;

Route::post('paystack/webhook', PaystackWebhookController::class)
        ->middleware(VerifyPaystackWebhookSignature::class)
        ->name('paystack.webhook');
