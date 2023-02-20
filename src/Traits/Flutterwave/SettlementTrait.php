<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait SettlementTrait
{
    /**
     * Get the settlement information for a given settlement ID
     *
     * @param  int  $settlementId The settlement ID to get information for.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getSettlement(int $settlementId): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: FlutterwaveConstant::SETTLEMENT_ENDPOINT.$settlementId,
            isJsonRequest: true
        );
    }

    /**
     * Get information for all settlements.
     *
     * @return array An array of all settlement information.
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getAllSettlements(array $queryParams = []): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: FlutterwaveConstant::SETTLEMENT_ENDPOINT,
            isJsonRequest: true,
            queryParams: $queryParams
        );
    }
}
