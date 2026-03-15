<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use Exception;

class InvalidPaymentWebhookHandler extends Exception
{
    /**
     * A custom exception that is thrown when the handler is invalid
     */
    public static function invalidHandler(string $configNotFoundName): self
    {
        return new self("The webhook handler for `{$configNotFoundName}` is invalid. Please ensure that the `payment_webhook_handler` config key is entered correctly.");
    }
}
