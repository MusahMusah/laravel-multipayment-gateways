<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Paystack;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface PaystackTransferContract
{
    /**
     * Hit Paystack's API to create a Transfer Recipient
     */
    public function createTransferRecipient(array $payload): PaymentResponse;

    /**
     * Hit Paystack's API to create bulk transfers recipients
     */
    public function createBulkTransferRecipients(array $recipients): PaymentResponse;

    /**
     * Hit Paystack's API to initiate a Transfer
     */
    public function initiateTransfer(array $payload): PaymentResponse;

    /**
     * Hit Paystack's API to initiate a Bulk Transfer
     */
    public function initiateBulkTransfer(array $transfers): PaymentResponse;

    /**
     * Hit Paystack's API to finalize a Transfer
     */
    public function finalizeTransfer(array $payload): PaymentResponse;

    /**
     * Hit Paystack's API to verify a Transfer
     */
    public function verifyTransfer(string $reference): PaymentResponse;

    /**
     * Hit Paystack's API to fetch a Transfer
     */
    public function getTransfer(string $transferCode): PaymentResponse;

    /**
     * Hit Paystack's API to fetch all Transfers
     */
    public function getAllTransfers(): PaymentResponse;
}
