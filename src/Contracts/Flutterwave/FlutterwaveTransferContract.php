<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveTransferContract
{
    // TransferBeneficiaryTrait methods

    public function createTransferBeneficiary(array $transferBeneficiaryDetails): PaymentResponse;

    public function getAllTransferBeneficiaries(array $queryParams = []): PaymentResponse;

    public function getTransferBeneficiary(int $beneficiaryId): PaymentResponse;

    public function deleteTransferBeneficiary(int $beneficiaryId): PaymentResponse;

    // TransferTrait methods

    public function initiateTransfer(array $formParams): PaymentResponse;

    public function getAllTransfers(array $queryParams = []): PaymentResponse;

    public function getTransferFees(array $queryParams = []): PaymentResponse;

    public function createBulkTransfer(array $bulkTransferData, string $title = ''): PaymentResponse;

    public function getTransfer(int $transferId): PaymentResponse;

    public function getTransferRates(array $queryParams): PaymentResponse;

    public function retryTransfer(int $transferId): PaymentResponse;

    public function getTransferRetry(int $transferId): PaymentResponse;

    public function fetchBulkTransfer(array $queryParams): PaymentResponse;
}
