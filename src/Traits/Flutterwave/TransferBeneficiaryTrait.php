<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait TransferBeneficiaryTrait
{
    /**
     * Create a Transfer Beneficiary
     *
     * This method allows you to create beneficiaries for Transfers.
     *
     * @param array $transferBeneficiaryDetails
     * @return mixed
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function createTransferBeneficiary(array $transferBeneficiaryDetails): mixed
    {
        $endpoint = sprintf('%s%s', $this->baseUri, FlutterwaveConstant::BENEFICIARY_ENDPOINT);

        return $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            formParams: $transferBeneficiaryDetails,
            isJsonRequest: true
        );
    }

    /**
     * List all Transfer Beneficiaries
     *
     * This function retrieves all transfer beneficiaries on the account
     *
     * @param array $queryParams [optional]
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getAllTransferBeneficiaries(array $queryParams = []): array
    {
        $endpoint = sprintf('%s%s', $this->baseUri, FlutterwaveConstant::BENEFICIARY_ENDPOINT);

        return $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true,
            queryParams: $queryParams
        );
    }

    /**
     * Fetch a Transfer Beneficiary
     *
     * This method allows you to retrieve a single transfer beneficiary.
     *
     * @param int $beneficiaryId
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getTransferBeneficiary(int $beneficiaryId): array
    {
        $endpoint = sprintf('%s%s%s', $this->baseUri, FlutterwaveConstant::BENEFICIARY_ENDPOINT, $beneficiaryId);

        return $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );
    }

    /**
     * Delete a Transfer Beneficiary
     *
     * This endpoint allows you to delete a transfer beneficiary
     *
     * @param int $beneficiaryId
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function deleteTransferBeneficiary(int $beneficiaryId): array
    {
        $endpoint = sprintf('%s%s%s', $this->baseUri, FlutterwaveConstant::BENEFICIARY_ENDPOINT, $beneficiaryId);

        return $this->makeRequest(
            method: 'DELETE',
            requestUrl: $endpoint,
            isJsonRequest: true
        );
    }
}
