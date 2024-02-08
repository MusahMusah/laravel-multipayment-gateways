<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;

trait SettlementTrait
{
    /**
     * Get the settlement information for a given settlement ID
     *
     * @param  int  $settlementId  The settlement ID to get information for.
     */
    public function getSettlement(int $settlementId): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::SETTLEMENT_ENDPOINT.$settlementId,
        );
    }

    /**
     * Get information for all settlements.
     *
     * @return array An array of all settlement information.
     */
    public function getAllSettlements(array $queryParams = []): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::SETTLEMENT_ENDPOINT,
            query: $queryParams
        );
    }
}
