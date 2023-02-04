<?php

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use Exception;

class InvalidPaymentWebhookHandler extends Exception
{
    /**
     * A custom exception that is thrown when the handler is invalid
     *
     * @param  string  $configNotFoundName
     * @return self
     */
    public static function invalidHandler($configNotFoundName): self
    {
        return new self("The webhook handler for `{$configNotFoundName}` is invalid. Please ensure that the `payment_webhook_handler` config key is entered correctly.");
    }
}
