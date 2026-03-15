<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;
use MusahMusah\LaravelMultipaymentGateways\Enums\FlutterwaveChargeType;

trait ChargeTrait
{
    /**
     * Initiate a debit or credit card payment.
     *
     * @param  array  $formParams  An associative array of payment data.
     */
    public function initiateCardCharge(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::CARD, $formParams);
    }

    /**
     * Initiate a bank transfer payment.
     *
     * @param  array  $formParams  An associative array of transfer data.
     */
    public function initiateBankTransfer(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::BANK_TRANSFER, $formParams);
    }

    /**
     * Charge Nigerian bank accounts using Flutterwave
     *
     * This method charges a Nigerian bank account using Flutterwave. It requires the bank numeric code, account number,
     * amount, email address and transaction reference to be provided in the request body.
     *
     * @param  array  $formParams  An associative array of transfer data.
     */
    public function chargeNigerianBankAccount(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::NG_ACCOUNT_DEBIT, $formParams);
    }

    /**
     * Charge UK Bank Accounts
     *
     * This payment method helps you charge UK Bank accounts using Flutterwave.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUkBankAccount(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::UK_ACCOUNT_DEBIT, $formParams);
    }

    /**
     * Charge ACH Payments via Flutterwave.
     *
     * This payment method allows you to collect USD and ZAR payments via ACH.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeAchPayment(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::ACH_PAYMENT, $formParams);
    }

    /**
     * Charge a customer using Apple Pay
     *
     * This payment method allows you to accept payments from your customers via Apple Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeApplePay(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::APPLE_PAY, $formParams);
    }

    /**
     * Charge a customer using Google Pay
     *
     * This payment method allows you to accept payments from your customers via Google Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeGooglePay(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::GOOGLE_PAY, $formParams);
    }

    /**
     * Charge a customer's payment method using Fawry Pay.
     *
     * This payment method allows you to accept payments from your customers via Fawry Pay.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeFawryPay(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::FAWRY_PAY, $formParams);
    }

    /**
     * Charge a customer's payment method using PayPal.
     *
     * This payment method allows you to accept payments from your customers via PayPal.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargePaypal(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::PAYPAL, $formParams);
    }

    /**
     * Charge a customer's payment method using M-Pesa.
     *
     * This payment method allows you to accept payments from your customers via M-Pesa.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMpesa(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::MPESA, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Ghana.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Ghana.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeGhanaMobileMoney(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::GHANA_MOBILE_MONEY, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Uganda.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Uganda.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUgandaMobileMoney(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::UGANDA_MOBILE_MONEY, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Franco
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Franco.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMobileMoneyFranco(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::FRANCOPHONE_MOBILE_MONEY, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Rwanda
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Rwanda.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMobileMoneyRwanda(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::RWANDA_MOBILE_MONEY, $formParams);
    }

    /**
     * Charge a customer using mobile money in Zambia.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Zambia.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeZambiaMobileMoney(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::ZAMBIA_MOBILE_MONEY, $formParams);
    }

    /**
     * Charge a customer using USSD
     *
     * This payment method allows you to accept payments from your customers via USSD.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUssd(array $formParams): PaymentResponse
    {
        return $this->chargePayment(FlutterwaveChargeType::USSD, $formParams);
    }

    /**
     * Validate a charge.
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function validateCharge(array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/validate-charge',
                data: $formParams,
            )
        );
    }

    /**
     * Capture payment for an existing uncaptured charge.
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function captureCharge(string $flwRef, array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/'.$flwRef.'/capture',
                data: $formParams
            )
        );
    }

    /**
     * Void a previously captured charge to release the hold on the funds.
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     */
    public function voidCharge(string $flwRef): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/'.$flwRef.'/void',
            )
        );
    }

    /**
     * Create a refund for an existing charge
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function createRefund(string $flwRef, array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/'.$flwRef.'/refund',
                data: $formParams,
            )
        );
    }

    /**
     * Capture the payment of a previously uncaptured PayPal charge
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function capturePaypalCharge(array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/'.'/paypal-capture',
                data: $formParams,
            )
        );
    }

    /**
     * Void a previously captured charge to release the hold on the funds.
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function voidPaypalCharge(array $formParams): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/'.'/void',
                data: $formParams,
            )
        );
    }

    /**
     * Charge a customer's payment using the specified payment method.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    private function chargePayment(FlutterwaveChargeType $chargeType, array $formParams): PaymentResponse
    {
        $queryParams = [
            'type' => $chargeType->value,
        ];

        return PaymentResponse::fromArray(
            $this->httpClient()->post(
                url: '/charges/',
                data: $formParams,
                query: $queryParams
            )
        );
    }
}
