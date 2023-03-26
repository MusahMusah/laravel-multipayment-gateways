<?php

namespace MusahMusah\LaravelMultipaymentGateways\SignatureValidator;

use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;

class DefaultSignatureValidator implements PaymentWebhookSignatureValidator
{
    public function isValid(Request $request, PaymentWebhookConfig $config): bool
    {
        if (! config(key: $config->verify_signature)) return true;

        if ((! $request->isMethod(method: 'post')) || ! $request->header(key: $config->signatureHeaderName)) return false;

        $signature = $this->validateSignature(gatewayName: $config->name, requestContent: $request->getContent(), signingSecret: $config->signingSecret);

        if ($signature !== $request->header(key: $config->signatureHeaderName)) return false;

        return hash_equals(known_string: $signature, user_string: $request->header(key: $config->signatureHeaderName));
    }

    private function validateSignature($gatewayName, $requestContent, $signingSecret): string
    {
        // @phpstan-ignore-next-line
        return match ($gatewayName) {
            'paystack' => hash_hmac(algo: 'sha512', data: $requestContent, key: $signingSecret),
            'stripe', 'flutterwave' => hash_hmac(algo: 'sha256', data: $requestContent, key: $signingSecret),
        };
    }
}
