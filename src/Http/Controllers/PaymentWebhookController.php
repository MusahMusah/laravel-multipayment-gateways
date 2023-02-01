<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Controllers;

use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookHandler;

class PaymentWebhookController
{
    public function __invoke(Request $request, PaymentWebhookConfig $config)
    {
        return (new PaymentWebhookHandler($request, $config))->handle();
    }
}
