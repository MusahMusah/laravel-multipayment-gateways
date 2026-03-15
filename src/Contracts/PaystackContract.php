<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

use MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack\PaystackBankContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack\PaystackTransactionContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack\PaystackTransferContract;

interface PaystackContract extends GatewayContract, PaystackBankContract, PaystackTransactionContract, PaystackTransferContract {}
