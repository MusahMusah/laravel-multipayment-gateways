<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveSettlementContract
{
    public function getSettlement(int $settlementId): PaymentResponse;

    public function getAllSettlements(array $queryParams = []): PaymentResponse;
}
