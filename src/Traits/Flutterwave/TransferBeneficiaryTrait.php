<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;

trait TransferBeneficiaryTrait
{
    /**
     * Create a Transfer Beneficiary
     *
     * This method allows you to create beneficiaries for Transfers.
     */
    public function createTransferBeneficiary(array $transferBeneficiaryDetails): mixed
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::BENEFICIARY_ENDPOINT,
            formParams: $transferBeneficiaryDetails
        );
    }

    /**
     * List all Transfer Beneficiaries
     *
     * This function retrieves all transfer beneficiaries on the account
     *
     * @param  array  $queryParams  [optional]
     */
    public function getAllTransferBeneficiaries(array $queryParams = []): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::BENEFICIARY_ENDPOINT,
            query: $queryParams
        );
    }

    /**
     * Fetch a Transfer Beneficiary
     *
     * This method allows you to retrieve a single transfer beneficiary.
     */
    public function getTransferBeneficiary(int $beneficiaryId): array
    {
        return $this->httpClient()->get(
            url: FlutterwaveConstant::BENEFICIARY_ENDPOINT.$beneficiaryId,
        );
    }

    /**
     * Delete a Transfer Beneficiary
     *
     * This endpoint allows you to delete a transfer beneficiary
     */
    public function deleteTransferBeneficiary(int $beneficiaryId): array
    {
        return $this->httpClient()->delete(
            url: FlutterwaveConstant::BENEFICIARY_ENDPOINT.$beneficiaryId,
        );
    }
}
