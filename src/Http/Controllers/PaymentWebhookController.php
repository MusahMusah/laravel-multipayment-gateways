<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookHandler;

class PaymentWebhookController
{
    public function __invoke(Request $request, PaymentWebhookConfig $config): JsonResponse
    {
        return (new PaymentWebhookHandler($request, $config))->handle();
    }
}
