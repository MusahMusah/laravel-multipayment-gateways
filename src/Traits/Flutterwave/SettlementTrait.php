<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait SettlementTrait
{
    /**
     * Get the settlement information for a given settlement ID
     * @param int $settlementId The settlement ID to get information for.
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getSettlement(int $settlementId): array
    {
        $endpoint = sprintf('%s%s%s', $this->baseUri, FlutterwaveConstant::SETTLEMENT_ENDPOINT, $settlementId);

        return $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );
    }

    /**
     * Get information for all settlements.
     *
     * @param array $queryParams
     * @return array An array of all settlement information.
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getAllSettlements(array $queryParams = []): array
    {
        $endpoint = sprintf('%s%s', $this->baseUri, FlutterwaveConstant::SETTLEMENT_ENDPOINT);

        return $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true,
            queryParams: $queryParams
        );
    }
}
