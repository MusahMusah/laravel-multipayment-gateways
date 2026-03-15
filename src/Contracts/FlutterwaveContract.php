<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface FlutterwaveContract
{
    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(array &$queryParams, array|string &$formParams, array &$headers): void;

    /**
     * Set the access token for the request
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     */
    public function decodeResponse(): array|string;

    /**
     * Get the response
     */
    public function getResponse(): array;

    /**
     * Get the data from the response
     */
    public function getData(): array;

    // TransactionTrait

    public function verifyTransaction(string $transactionId): array;

    public function createTransactionRefund(string $transactionId, array $formParams = []): array;

    public function getTransactions(array $queryParams = []): array;

    public function getRefundTransactions(array $queryParams = []): array;

    public function getRefundDetails(string $refundId): array;

    public function getTransactionFee(array $queryParams): array;

    public function resendFailedWebhook(string $transactionId, array $formParams = []): array;

    public function viewTransactionTimeline(string $transactionId): array;

    // BankTrait

    public function getBanks(string $countryCode): array;

    public function getBankBranches(int $bankId): array;

    // ChargeTrait

    public function initiateCardCharge(array $formParams): array;

    public function initiateBankTransfer(array $formParams): array;

    public function chargeNigerianBankAccount(array $formParams): array;

    public function chargeUkBankAccount(array $formParams): array;

    public function chargeAchPayment(array $formParams): array;

    public function chargeApplePay(array $formParams): array;

    public function chargeGooglePay(array $formParams): array;

    public function chargeFawryPay(array $formParams): array;

    public function chargePaypal(array $formParams): array;

    public function chargeMpesa(array $formParams): array;

    public function chargeGhanaMobileMoney(array $formParams): array;

    public function chargeUgandaMobileMoney(array $formParams): array;

    public function chargeMobileMoneyFranco(array $formParams): array;

    public function chargeMobileMoneyRwanda(array $formParams): array;

    public function chargeZambiaMobileMoney(array $formParams): array;

    public function chargeUssd(array $formParams): array;

    public function validateCharge(array $formParams): array;

    public function captureCharge(string $flwRef, array $formParams): array;

    public function voidCharge(string $flwRef): array;

    public function createRefund(string $flwRef, array $formParams): array;

    public function capturePaypalCharge(array $formParams): array;

    public function voidPaypalCharge(array $formParams): array;

    // OtpTrait

    public function createOtp(array $formParams): array;

    public function verifyOtp(string $reference, array $formParams): array;

    // PaymentPlanTrait

    public function createPaymentPlan(array $planDetails): array;

    public function updatePaymentPlan(int $paymentPlanId, array $planDetails): array;

    public function getAllPaymentPlans(array $queryParams = []): array;

    public function getPaymentPlan(int $paymentPlanId): array;

    public function cancelPaymentPlan(int $paymentPlanId): array;

    // SettlementTrait

    public function getSettlement(int $settlementId): array;

    public function getAllSettlements(array $queryParams = []): array;

    // SubscriptionTrait

    public function getAllSubscriptions(array $queryParams = []): array;

    public function activateSubscription(int $subscriptionId): array;

    public function deactivateSubscription(int $subscriptionId): array;

    // TransferBeneficiaryTrait

    public function createTransferBeneficiary(array $transferBeneficiaryDetails): array;

    public function getAllTransferBeneficiaries(array $queryParams = []): array;

    public function getTransferBeneficiary(int $beneficiaryId): array;

    public function deleteTransferBeneficiary(int $beneficiaryId): array;

    // TransferTrait

    public function initiateTransfer(array $formParams): array;

    public function getAllTransfers(array $queryParams = []): array;

    public function getTransferFees(array $queryParams = []): array;

    public function createBulkTransfer(array $bulkTransferData, string $title = ''): array;

    public function getTransfer(int $transferId): array;

    public function getTransferRates(array $queryParams): array;

    public function retryTransfer(int $transferId): array;

    public function getTransferRetry(int $transferId): array;

    public function fetchBulkTransfer(array $queryParams): array;
}