<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveTransactionContract
{
    public function verifyTransaction(string $transactionId): PaymentResponse;

    public function createTransactionRefund(string $transactionId, array $formParams = []): PaymentResponse;

    public function getTransactions(array $queryParams = []): PaymentResponse;

    public function getRefundTransactions(array $queryParams = []): PaymentResponse;

    public function getRefundDetails(string $refundId): PaymentResponse;

    public function getTransactionFee(array $queryParams): PaymentResponse;

    public function resendFailedWebhook(string $transactionId, array $formParams = []): PaymentResponse;

    public function viewTransactionTimeline(string $transactionId): PaymentResponse;
}
