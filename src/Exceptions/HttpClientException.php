<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Exceptions;

use Exception;

class HttpClientException extends Exception
{
    protected $message = 'An error occurred while sending the request to the payment gateway';
}
