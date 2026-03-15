<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

interface FlutterwaveChargeContract
{
    public function initiateCardCharge(array $formParams): PaymentResponse;

    public function initiateBankTransfer(array $formParams): PaymentResponse;

    public function chargeNigerianBankAccount(array $formParams): PaymentResponse;

    public function chargeUkBankAccount(array $formParams): PaymentResponse;

    public function chargeAchPayment(array $formParams): PaymentResponse;

    public function chargeApplePay(array $formParams): PaymentResponse;

    public function chargeGooglePay(array $formParams): PaymentResponse;

    public function chargeFawryPay(array $formParams): PaymentResponse;

    public function chargePaypal(array $formParams): PaymentResponse;

    public function chargeMpesa(array $formParams): PaymentResponse;

    public function chargeGhanaMobileMoney(array $formParams): PaymentResponse;

    public function chargeUgandaMobileMoney(array $formParams): PaymentResponse;

    public function chargeMobileMoneyFranco(array $formParams): PaymentResponse;

    public function chargeMobileMoneyRwanda(array $formParams): PaymentResponse;

    public function chargeZambiaMobileMoney(array $formParams): PaymentResponse;

    public function chargeUssd(array $formParams): PaymentResponse;

    public function validateCharge(array $formParams): PaymentResponse;

    public function captureCharge(string $flwRef, array $formParams): PaymentResponse;

    public function voidCharge(string $flwRef): PaymentResponse;

    public function createRefund(string $flwRef, array $formParams): PaymentResponse;

    public function capturePaypalCharge(array $formParams): PaymentResponse;

    public function voidPaypalCharge(array $formParams): PaymentResponse;
}
