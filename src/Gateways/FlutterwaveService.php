<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Gateways;

use MusahMusah\LaravelMultipaymentGateways\Abstracts\BaseGateWay;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\BankTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\ChargeTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\OtpTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\PaymentPlanTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\SettlementTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\SubscriptionTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\TransactionTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\TransferBeneficiaryTrait;
use MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave\TransferTrait;

class FlutterwaveService extends BaseGateWay implements FlutterwaveContract
{
    use BankTrait,
        ChargeTrait,
        OtpTrait,
        PaymentPlanTrait,
        SettlementTrait,
        SubscriptionTrait,
        TransactionTrait,
        TransferBeneficiaryTrait,
        TransferTrait;

    protected function gatewayName(): string
    {
        return 'flutterwave';
    }
}
