<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob;
use MusahMusah\LaravelMultipaymentGateways\Models\PaymentWebhookLog;
use MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator;

class PaymentWebhookConfig
{
    public string $name;

    public string $signingSecret;

    public string $signatureHeaderName;

    public PaymentWebhookSignatureValidator $signatureValidator;

    public string $paymentWebhookModel;

    public string $paymentWebhookHandler;

    public string|ProcessPaymentWebhookJob $paymentWebhookJobClass;

    public string|PaymentWebhookReceivedEvent $paymentWebhookEventClass;

    /**
     * @throws InvalidPaymentWebhookConfig
     */
    public function __construct(array $properties)
    {
        $this->name = $properties['name'];

        $this->signingSecret = $properties['signing_secret'] ?? '';

        $this->signatureHeaderName = $properties['signature_header_name'] ?? '';

        $this->paymentWebhookModel = PaymentWebhookLog::class;

        $this->paymentWebhookHandler = $properties['payment_webhook_handler'];

        if (! empty($properties['signature_validator']) && ! is_subclass_of($properties['signature_validator'], PaymentWebhookSignatureValidator::class)) {
            throw InvalidPaymentWebhookConfig::invalidSignatureValidator($properties['signature_validator']);
        }

        $this->signatureValidator = app($properties['signature_validator']);

        if (! empty($properties['payment_webhook_job']) && ! is_subclass_of($properties['payment_webhook_job'], ProcessPaymentWebhookJob::class)) {
            throw InvalidPaymentWebhookConfig::invalidWebhookJob($properties['payment_webhook_job']);
        }

        $this->paymentWebhookJobClass = $properties['payment_webhook_job'];

        if (! empty($properties['payment_webhook_event']) && ! is_subclass_of($properties['payment_webhook_event'], PaymentWebhookReceivedEvent::class)) {
            throw InvalidPaymentWebhookConfig::invalidWebhookEvent($properties['payment_webhook_event']);
        }

        $this->paymentWebhookEventClass = $properties['payment_webhook_event'];
    }
}
