<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait SettlementTrait
{
    const SETTLEMENT_ENDPOINT = '/settlements/';

    /**
     * Get the settlement information for a given settlement ID
     *
     * @param  int  $settlementId The ID of the settlement to retrieve information for
     * @return mixed The settlement information
     */
    public function getSettlement(int $settlementId): mixed
    {
        $endpoint = $this->baseUri.self::SETTLEMENT_ENDPOINT.$settlementId;

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
     * @param  array  $options An array of optional parameters to use in the API request
     *
     * @option int $page The page number to retrieve (e.g. setting 1 retrieves the first page).
     * @option string $from The specified date to start the list from (YYYY-MM-DD).
     * @option string $to The specified end period for the search (YYYY-MM-DD).
     * @option string $subaccount_id The unique id of the sub account to retrieve.
     *
     * @return array An array of all settlement information.
     */
    public function getAllSettlements(array $options = []): array
    {
        $endpoint = $this->baseUri.self::SETTLEMENT_ENDPOINT;

        $settlements = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $options,
            isJsonRequest: true
        );

        return $settlements;
    }
}
