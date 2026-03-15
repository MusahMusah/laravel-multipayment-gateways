<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\SignatureValidator;

use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Enums\PaymentGateway;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use SensitiveParameter;

class DefaultSignatureValidator implements PaymentWebhookSignatureValidator
{
    public function isValid(Request $request, PaymentWebhookConfig $config): bool
    {
        if (! config(key: $config->verifySignature)) {
            return true;
        }

        if ((! $request->isMethod(method: 'post')) || ! $request->header(key: $config->signatureHeaderName)) {
            return false;
        }

        $signature = $this->validateSignature(
            gateway: PaymentGateway::from($config->name),
            requestContent: $request->getContent(),
            signingSecret: $config->signingSecret,
        );

        if ($signature !== $request->header(key: $config->signatureHeaderName)) {
            return false;
        }

        return hash_equals(known_string: $signature, user_string: $request->header(key: $config->signatureHeaderName));
    }

    private function validateSignature(PaymentGateway $gateway, string $requestContent, #[SensitiveParameter] string $signingSecret): string
    {
        return hash_hmac(algo: $gateway->hmacAlgorithm(), data: $requestContent, key: $signingSecret);
    }
}
