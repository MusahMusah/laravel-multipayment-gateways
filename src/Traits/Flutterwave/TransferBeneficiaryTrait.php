<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait TransferBeneficiaryTrait
{
    const BENEFICIARY_ENDPOINT = '/beneficiaries/';

    /**
     * Create a Transfer Beneficiary
     *
     * This method allows you to create beneficiaries for Transfers.
     *
     * @param array $transferBeneficiaryDetails
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
<<<<<<< HEAD
     * @param array $queryParams [optional]
     *
     * @return array
     */
    public function getAllTransferBeneficiaries($queryParams = []) : array
=======
     * @param  array  $options [optional] The options array. It can include the following keys:
     *  - page (int): This is the page number to retrieve e.g. setting 1 retrieves the first page.
     * @return array An array of all payment plans information
     */
    public function getAllTransferBeneficiaries($options = []): array
>>>>>>> 147c762795941bdd56957373265b87f5ae710650
    {
        $endpoint = $this->baseUri.self::BENEFICIARY_ENDPOINT;

        $transferBeneficiary = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            isJsonRequest: true
        );

        return $transferBeneficiary;
    }

    /**
     * Fetch a Transfer Beneficiary
     *
     * This method allows you to retrieve a single transfer beneficiary.
     *
<<<<<<< HEAD
     * @param int $beneficiaryId
     *
     * @return array
=======
     * @param  int  $beneficiaryId - The unique ID of the transfer beneficiary you want to retrieve.
     * @return array The transfer beneficiary data.
>>>>>>> 147c762795941bdd56957373265b87f5ae710650
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
<<<<<<< HEAD
     * @param int $beneficiaryId
     *
     * @return array
=======
     * @param  int  $beneficiaryId - The unique ID of the transfer beneficiary you want to delete
     * @return array - The API response
>>>>>>> 147c762795941bdd56957373265b87f5ae710650
     */
    public function deleteTransferBeneficiary(int $beneficiaryId)
    {
        $endpoint = $this->baseUri.self::BENEFICIARY_ENDPOINT.$beneficiaryId;

        $response = $this->makeRequest(
            method: 'DELETE',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $response;
    }
}
