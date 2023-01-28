<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

use Illuminate\Http\Request;

interface PaymentWebhookSignatureValidator
{
    public function isValid(Request $request, PaymentWebhookConfig $config): bool;
}
