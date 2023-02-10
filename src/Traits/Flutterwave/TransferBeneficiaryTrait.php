<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait TransferBeneficiaryTrait
{
    CONST BENEFICIARY_ENDPOINT = '/beneficiaries/';

     /**
     * Create a Transfer Beneficiary
     *
     * This method allows you to create beneficiaries for Transfers.
     *
     * @param array $params An array of parameters which includes:
     *  - `account_bank` (string) - The Bank numeric code, which can be retrieved from the /get banks endpoint.
     *  - `account_number` (string) - The account number of the customer.
     *  - `beneficiary_name` (string) - The name of the beneficiary for the Transfer.
     *  - `currency` (string) - [optional] The currency of the country of the beneficiary bank. If country is KE, supply KES, if NG, supply NGN.
     *  - `bank_name` (string) - [optional] The name of the beneficiary bank.
     *
     * @return mixed
     */
    public function createTransferBeneficiary(array $transferBeneficiaryDetails)
    {
        $endpoint = $this->baseUri.self::BENEFICIARY_ENDPOINT;

        $transferBeneficiary = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            formParams: $transferBeneficiaryDetails,
            isJsonRequest: true
        );

        return $transferBeneficiary;
    }

    /**
     * List all Transfer Beneficiaries
     *
     * This function retrieves all transfer beneficiaries on the account
     *
     * @param array $options [optional] The options array. It can include the following keys:
     *  - page (int): This is the page number to retrieve e.g. setting 1 retrieves the first page.
     *
     * @return array An array of all payment plans information
     */
    public function getAllTransferBeneficiaries($options = []) : array
    {
        $endpoint = $this->baseUri . self::BENEFICIARY_ENDPOINT;

        $transferBeneficiary = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $options,
            isJsonRequest: true
        );

        return $transferBeneficiary;
    }

    /**
     * Fetch a Transfer Beneficiary
     *
     * This method allows you to retrieve a single transfer beneficiary.
     *
     * @param int $beneficiaryId - The unique ID of the transfer beneficiary you want to retrieve.
     *
     * @return array The transfer beneficiary data.
     */
    public function getTransferBeneficiary(int $beneficiaryId)
    {
        $endpoint = $this->baseUri.self::BENEFICIARY_ENDPOINT.$beneficiaryId;

        $transferBeneficiary = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $transferBeneficiary;
    }

    /**
     * Delete a Transfer Beneficiary
     *
     * This endpoint allows you to delete a transfer beneficiary
     *
     * @param int $beneficiaryId - The unique ID of the transfer beneficiary you want to delete
     *
     * @return array - The API response
     */
    public function deleteTransferBeneficiary(int $beneficiaryId)
    {
        $endpoint = $this->baseUri . self::BENEFICIARY_ENDPOINT . $beneficiaryId;

        $response = $this->makeRequest(
            method: 'DELETE',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }
}
