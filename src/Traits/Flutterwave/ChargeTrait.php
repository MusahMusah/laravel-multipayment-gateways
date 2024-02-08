<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

trait ChargeTrait
{
    /**
     * Initiate a debit or credit card payment.
     *
     * @param  array  $formParams  An associative array of payment data.
     *
     * @throws InvalidConfigurationException
     */
    public function initiateCardCharge(array $formParams): array
    {
        $queryParams = [
            'type' => FlutterwaveConstant::CARD_PAYMENT_CHARGE_TYPE,
        ];

        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT,
            formParams: $this->encryptPayload($formParams),
            query: $queryParams
        );
    }

    /**
     * Initiate a bank transfer payment.
     *
     * @param  array  $formParams  An associative array of transfer data.
     */
    public function initiateBankTransfer(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::BANK_TRANSFER_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge Nigerian bank accounts using Flutterwave
     *
     * This method charges a Nigerian bank account using Flutterwave. It requires the bank numeric code, account number,
     * amount, email address and transaction reference to be provided in the request body.
     *
     * @param  array  $formParams  An associative array of transfer data.
     */
    public function chargeNigerianBankAccount(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::NG_ACCOUNT_DEBIT_TYPE, $formParams);
    }

    /**
     * Charge UK Bank Accounts
     *
     * This payment method helps you charge UK Bank accounts using Flutterwave.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUkBankAccount(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::UK_ACCOUNT_DEBIT_TYPE, $formParams);
    }

    /**
     * Charge ACH Payments via Flutterwave.
     *
     * This payment method allows you to collect USD and ZAR payments via ACH.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeAchPayment(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::ACH_PAYMENT_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Apple Pay
     *
     * This payment method allows you to accept payments from your customers via Apple Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeApplePay(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::APPLE_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Google Pay
     *
     * This payment method allows you to accept payments from your customers via Google Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeGooglePay(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::APPLE_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using Fawry Pay.
     *
     * This payment method allows you to accept payments from your customers via Fawry Pay.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeFawryPay(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::FAWRY_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using PayPal.
     *
     * This payment method allows you to accept payments from your customers via PayPal.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargePaypal(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::PAYPAL_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using M-Pesa.
     *
     * This payment method allows you to accept payments from your customers via M-Pesa.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMpesa(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::MPESA_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Ghana.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Ghana.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeGhanaMobileMoney(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::GHANA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Uganda.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Uganda.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUgandaMobileMoney(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::UGANDA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Franco
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Franco.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMobileMoneyFranco(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::FRANCOPHONE_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Rwanda
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Rwanda.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeMobileMoneyRwanda(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::RWANDA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using mobile money in Zambia.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Zambia.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeZambiaMobileMoney(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::ZAMBIA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using USSD
     *
     * This payment method allows you to accept payments from your customers via USSD.
     *
     * @param  array  $formParams  An associative array of charge data.
     */
    public function chargeUssd(array $formParams): array
    {
        return $this->chargePayment(FlutterwaveConstant::USSD_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment using the specified payment method.
     *
     * @param  string  $paymentMethod  The payment method to use.
     * @param  array  $formParams  An associative array of charge data.
     */
    private function chargePayment(string $paymentMethod, array $formParams): array
    {
        $queryParams = [
            'type' => $paymentMethod,
        ];

        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT,
            formParams: $formParams,
            query: $queryParams
        );
    }

    /**
     *   Encrypts an array payload using 3DES-24 encryption.
     *
     * @param  array  $payload  The payload to be encrypted.
     * @return string The encrypted payload in base64 encoded format.
     *
     * @throws InvalidConfigurationException If the encryption key is missing.
     */
    private function encryptPayload(array $payload): string
    {
        $encryptionKey = $this->encryptionKey;

        if (! $encryptionKey) {
            throw new InvalidConfigurationException("The encryption key for `{$this->paymentGateway}` is missing. Please ensure that the `encryption_key` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $encrypted = openssl_encrypt(json_encode($payload), 'DES-EDE3', $encryptionKey, OPENSSL_RAW_DATA);

        return base64_encode($encrypted);
    }

    /**
     * Validate a charge.
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function validateCharge(array $formParams): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::VALIDATE_CHARGE_ENDPOINT,
            formParams: $formParams,
        );
    }

    /**
     * Capture payment for an existing uncaptured charge.
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function captureCharge(string $flwRef, array $formParams): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT.$flwRef.'/capture',
            formParams: $formParams
        );
    }

    /**
     * Void a previously captured charge to release the hold on the funds.
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     */
    public function voidCharge(string $flwRef): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT.$flwRef.'/void',
        );
    }

    /**
     * Create a refund for an existing charge
     *
     * @param  string  $flwRef  The data.flw_ref returned in the charge response.
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function createRefund(string $flwRef, array $formParams): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT.$flwRef.'/refund',
            formParams: $formParams,
        );
    }

    /**
     * Capture the payment of a previously uncaptured PayPal charge
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function capturePaypalCharge(array $formParams): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT.'/paypal-capture',
            formParams: $formParams,
        );
    }

    /**
     * Void a previously captured charge to release the hold on the funds.
     *
     * @param  array  $formParams  An associative array of charge validation data.
     */
    public function voidPaypalCharge(array $formParams): array
    {
        return $this->httpClient()->post(
            url: FlutterwaveConstant::CHARGE_ENDPOINT.'/void',
            formParams: $formParams,
        );
    }
}
