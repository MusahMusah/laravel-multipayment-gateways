<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\BankTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\TransactionTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Paystack\TransferTrait;

class PaystackService extends BaseGateWay implements PaystackContract
{
    use BankTrait,
        TransactionTrait,
        TransferTrait;

    protected function gatewayName(): string
    {
        return 'paystack';
    }
}
