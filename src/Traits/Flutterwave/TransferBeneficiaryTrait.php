<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;


trait TransferBeneficiaryTrait
{
    /**
     * Create a Transfer Beneficiary
     *
     * This method allows you to create beneficiaries for Transfers.
     */
    public function createTransferBeneficiary(array $transferBeneficiaryDetails): array
    {
        return $this->httpClient()->post(
            url: '/beneficiaries/',
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
            url: '/beneficiaries/',
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
            url: '/beneficiaries/'.$beneficiaryId,
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
            url: '/beneficiaries/'.$beneficiaryId,
        );
    }
}
