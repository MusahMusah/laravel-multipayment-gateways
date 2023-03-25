<?php

namespace MusahMusah\LaravelMultipaymentGateways\SignatureValidator;

use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;

class StripeSignatureValidator implements PaymentWebhookSignatureValidator
{

    public function isValid(Request $request, PaymentWebhookConfig $config): bool
    {
        // TODO: Implement isValid() method.
    }
}
