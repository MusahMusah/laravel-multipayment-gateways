<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait SettlementTrait
{
    const SETTLEMENT_ENDPOINT = '/settlements/';

    /**
     * Get the settlement information for a given settlement ID
     *
     * @param  int  $settlementId
     * @return mixed
     */
    public function getSettlement(int $settlementId): mixed
    {
        $endpoint = sprintf('%s%s%s', $this->baseUri, self::SETTLEMENT_ENDPOINT, $settlementId);

        $settlement = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $settlement;
    }

    /**
     * Get information for all settlements.
     *
     * @param  array  $queryParams
     * @return array An array of all settlement information.
     */
    public function getAllSettlements(array $queryParams = []): array
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::SETTLEMENT_ENDPOINT);

        $settlements = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $settlements;
    }
}
