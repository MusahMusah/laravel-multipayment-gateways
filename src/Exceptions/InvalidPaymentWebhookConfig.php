<?php

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use Exception;
use MusahMusah\LaravelMultipaymentGateways\Events\PaymentWebhookReceivedEvent;
use MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob;
use MusahMusah\LaravelMultipaymentGateways\SignatureValidator\PaymentWebhookSignatureValidator;

final class InvalidPaymentWebhookConfig extends Exception
{
    /**
     * An exception thrown when the webhook configuration is not found
     */
    public static function webhookConfigMissing(string $configNotFoundName): self
    {
        return new self("Could not find the webhook configuration for `{$configNotFoundName}`");
    }

    /**
     * An exception thrown when the signing secret is not set
     */
    public static function signingSecretMissing(string $configNotFoundName): self
    {
        return new self("The webhook signing secret for `{$configNotFoundName}` is missing. Please ensure that the `signing_secret` config key is set correctly.");
    }

    /**
     * An exception thrown an invalid webhook job class is provided
     *
     * @param  string  $processWebhookJob  the invalid class name
     */
    public static function invalidWebhookJob(string $processWebhookJob): self
    {
        $expectedWebhookJobClass = ProcessPaymentWebhookJob::class;

        return new self("`{$processWebhookJob}` is not a valid webhook job class. A valid class should implement `{$expectedWebhookJobClass}`.");
    }

    /**
     * An exception thrown when an invalid webhook event class is provided
     *
     * @param  string  $processWebhookEvent  the invalid class name
     */
    public static function invalidWebhookEvent(string $processWebhookEvent): self
    {
        $expectedWebhookEventClass = PaymentWebhookReceivedEvent::class;

        return new self("`{$processWebhookEvent}` is not a valid webhook job class. A valid class should implement `{$expectedWebhookEventClass}`.");
    }

    /**
     * An exception thrown when an invalid signature validator event class is provided
     *
     * @param  string  $processSignatureValidator  the invalid class name
     */
    public static function invalidSignatureValidator(string $processSignatureValidator): self
    {
        $expectedSignatureValidatorClass = PaymentWebhookSignatureValidator::class;

        return new self("`{$processSignatureValidator}` is not a valid signature validator class. A valid class should implement `{$expectedSignatureValidatorClass}`.");
    }

    /**
     * An exception thrown when the job class for handling a webhook request is missing
     */
    public static function missingJobClass(string $configNotFoundName): self
    {
        return new self("The job class for `{$configNotFoundName}` is missing. Please ensure that the `payment_webhook_job` config key is set correctly.");
    }

    /**
     * An exception thrown when the event class for handling a webhook request is missing
     */
    public static function missingEventClass(string $configNotFoundName): self
    {
        return new self("The event class for `{$configNotFoundName}` is missing. Please ensure that the `payment_webhook_event` config key is set correctly.");
    }
}
