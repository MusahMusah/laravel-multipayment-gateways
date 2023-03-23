<?php

namespace MusahMusah\LaravelMultipaymentGateways\SignatureValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;

class FlutterwaveSignatureValidator implements PaymentWebhookSignatureValidator
{
    public function isValid(Request $request, PaymentWebhookConfig $config): bool
    {
        if ((! $request->isMethod('post')) || ! $request->hasHeader($config->signatureHeaderName)) {
            return false;
        }

        $signature = $request->header($config->signatureHeaderName);
        $requestContent = $request->getContent();
        $signingSecret = $config->signingSecret;

        if (empty($signingSecret)) {
            Log::error('The `FLUTTERWAVE_SECRET_HASH` is missing or not set in your env.');

            return false;
        }

        $generatedSignature = hash_hmac('sha256', $requestContent, $signingSecret);

        return hash_equals($generatedSignature, $signature);
    }
}
