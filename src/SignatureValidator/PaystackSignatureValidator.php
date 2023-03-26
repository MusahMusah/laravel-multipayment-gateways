<?php

namespace MusahMusah\LaravelMultipaymentGateways\SignatureValidator;

use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;

class PaystackSignatureValidator implements PaymentWebhookSignatureValidator
{
    public function isValid(Request $request, PaymentWebhookConfig $config): bool
    {
        if ((! $request->isMethod(method: 'post')) || ! $request->header(key: $config->signatureHeaderName)) return false;

        $requestContent = $request->getContent();
        $signature = hash_hmac(algo: 'sha512', data: $requestContent, key: $config->signingSecret);

        if ($signature !== $request->header(key: $config->signatureHeaderName)) return false;

        return hash_equals(known_string: $signature, user_string: $request->header($config->signatureHeaderName));
    }
}
