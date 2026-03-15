<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait SettlementTrait
{
    /**
     * Get the settlement information for a given settlement ID
     *
     * @param  int  $settlementId  The settlement ID to get information for.
     */
    public function getSettlement(int $settlementId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/settlements/'.$settlementId,
            )
        );
    }

    /**
     * Get information for all settlements.
     *
     * @return PaymentResponse An array of all settlement information.
     */
    public function getAllSettlements(array $queryParams = []): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/settlements/',
                query: $queryParams
            )
        );
    }
}
