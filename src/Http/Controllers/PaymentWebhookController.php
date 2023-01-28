<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Controllers;

use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookHandler;
use Illuminate\Http\Request;

class PaymentWebhookController
{
    public function __invoke(Request $request, PaymentWebhookConfig $config)
    {
        return (new PaymentWebhookHandler($request, $config))->handle();
    }
}
