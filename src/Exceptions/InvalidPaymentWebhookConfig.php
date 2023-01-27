<?php

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use MusahMusah\LaravelMultipaymentGateways\Jobs\ProcessPaymentWebhookJob;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookSignatureValidator;
use Exception;

class InvalidPaymentWebhookConfig extends Exception
{
    /**
     * An exception thrown when the webhook configuration is not found
     *
     * @param string $configNotFoundName
     * @return self
     */
    public static function webhookConfigMissing(string $configNotFoundName): self
    {
        return new static("Could not find the webhook configuration for `{$configNotFoundName}`");
    }

    /**
     * An exception thrown when the signing secret is not set
     *
     * @param string $configNotFoundName
     * @return self
     */
    public static function signingSecretMissing(string $configNotFoundName): self
    {
        return new static("The webhook signing secret for `{$configNotFoundName}` is missing. Please ensure that the `signing_secret` config key is set correctly.");
    }

    /**
     * An exception thrown an invalid webhook job class is provided
     *
     * @param string $processWebhookJob the invalid class name
     * @return self
     */
    public static function invalidWebhookJob(string $processWebhookJob): self
    {
        $expectedWebhookJobClass = ProcessPaymentWebhookJob::class;

        return new static("`{$processWebhookJob}` is not a valid webhook job class. A valid class should implement `{$expectedWebhookJobClass}`.");
    }

    /**
     * An exception thrown when an invalid webhook event class is provided
     *
     * @param string $processWebhookEvent the invalid class name
     * @return self
     */
    public static function invalidWebhookEvent(string $processWebhookEvent): self
    {
        $expectedWebhookEventClass = CustomPaymentWebhookReceivedEvent::class;

        return new static("`{$processWebhookEvent}` is not a valid webhook job class. A valid class should implement `{$expectedWebhookEventClass}`.");
    }

    /**
     * An exception thrown when an invalid signature validator event class is provided
     *
     * @param string $processSignatureValidator the invalid class name
     * @return self
     */
    public static function invalidSignatureValidator(string $processSignatureValidator): self
    {
        $expectedSignatureValidatorClass = PaymentWebhookSignatureValidator::class;

        return new static("`{$processSignatureValidator}` is not a valid signature validator class. A valid class should implement `{$expectedSignatureValidatorClass}`.");
    }
}
