<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

trait ChargeTrait
{
    const CHARGE_ENDPOINT = '/charges';

    const CARD_PAYMENT_CHARGE_TYPE = 'card';

    const BANK_TRANSFER_CHARGE_TYPE = 'bank_transfer';

    const NG_ACCOUNT_DEBIT_TYPE = 'debit_ng_account';

    const UK_ACCOUNT_DEBIT_TYPE = 'debit_uk_account';

    const ACH_PAYMENT_CHARGE_TYPE = 'ach_payment';

    const APPLE_PAY_CHARGE_TYPE = 'applepay';

    const GOOGLE_PAY_CHARGE_TYPE = 'googlepay';

    const FAWRY_PAY_CHARGE_TYPE = 'fawry_pay';

    const PAYPAL_CHARGE_TYPE = 'paypal';

    const MPESA_PAY_CHARGE_TYPE = 'mpesa';

    const GHANA_MOBILE_MONEY_CHARGE_TYPE = 'mobile_money_ghana';

    const UGANDA_MOBILE_MONEY_CHARGE_TYPE = 'mobile_money_uganda';

    const FRANCOPHONE_MOBILE_MONEY_CHARGE_TYPE = 'mobile_money_franco';

    const RWANDA_MOBILE_MONEY_CHARGE_TYPE = 'mobile_money_rwanda';

    const ZAMBIA_MOBILE_MONEY_CHARGE_TYPE = 'mobile_money_zambia';

    const USSD_CHARGE_TYPE = 'ussd';

    /**
     * Initiate a debit or credit card payment.
     *
     * @param  array  $formParams An associative array of payment data.
     * @return array
     */
    public function initiateCardPayment(array $formParams)
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::CHARGE_ENDPOINT);

        $queryParams = [
            'type' => self::CARD_PAYMENT_CHARGE_TYPE,
        ];

        $cardPaymentData = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            formParams: $this->encryptPayload($formParams),
            isJsonRequest: true
        );

        return $cardPaymentData;
    }

    /**
     * Initiate a bank transfer payment.
     *
     * @param  array  $formParams An associative array of tranfer data.
     */
    public function initiateBankTransfer(array $formParams): array
    {
        return $this->chargePayment(self::BANK_TRANSFER_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge Nigerian bank accounts using Flutterwave
     *
     * This method charges a Nigerian bank account using Flutterwave. It requires the bank numeric code, account number,
     * amount, email address and transaction reference to be provided in the request body.
     *
     * @param  array  $formParams An associative array of tranfer data.
     * @return array
     */
    public function chargeNigerianBankAccount(array $formParams)
    {
        return $this->chargePayment(self::NG_ACCOUNT_DEBIT_TYPE, $formParams);
    }

    /**
     * Charge UK Bank Accounts
     *
     * This payment method helps you charge UK Bank accounts using Flutterwave.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeUkBankAccount(array $formParams): array
    {
        return $this->chargePayment(self::UK_ACCOUNT_DEBIT_TYPE, $formParams);
    }

    /**
     * Charge ACH Payments via Flutterwave.
     *
     * This payment method allows you to collect USD and ZAR payments via ACH.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeAchPayment(array $formParams): array
    {
        return $this->chargePayment(self::ACH_PAYMENT_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Apple Pay
     *
     * This payment method allows you to accept payments from your customers via Apple Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams An associative array of charge data.
     * @return array
     */
    public function chargeApplePay($formParams)
    {
        return $this->chargePayment(self::APPLE_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Google Pay
     *
     * This payment method allows you to accept payments from your customers via Google Pay.
     * We recommend you read the method overview before you proceed.
     *
     * @param  array  $formParams An associative array of charge data.
     * @return array
     */
    public function chargeGooglePay($formParams)
    {
        return $this->chargePayment(self::APPLE_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using Fawry Pay.
     *
     * This payment method allows you to accept payments from your customers via Fawry Pay.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeFawryPay(array $formParams): array
    {
        return $this->chargePayment(self::FAWRY_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using PayPal.
     *
     * This payment method allows you to accept payments from your customers via PayPal.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargePaypal(array $formParams): array
    {
        return $this->chargePayment(self::PAYPAL_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using M-Pesa.
     *
     * This payment method allows you to accept payments from your customers via M-Pesa.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeMpesa(array $formParams): array
    {
        return $this->chargePayment(self::MPESA_PAY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Ghana.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Ghana.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeGhanaMobileMoney(array $formParams): array
    {
        return $this->chargePayment(self::GHANA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment method using mobile money in Uganda.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Uganda.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeUgandaMobileMoney(array $formParams): array
    {
        return $this->chargePayment(self::UGANDA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Franco
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Franco.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeMobileMoneyFranco(array $formParams): array
    {
        return $this->chargePayment(self::FRANCOPHONE_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using Mobile Money Rwanda
     *
     * This payment method allows you to accept payments from your customers via Mobile Money Rwanda.
     *
     * @param  array  $formParams An associative array of charge data.
     */
    public function chargeMobileMoneyRwanda(array $formParams): array
    {
        return $this->chargePayment(self::RWANDA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using mobile money in Zambia.
     *
     * This payment method allows you to accept payments from your customers via mobile money in Zambia.
     *
     * @param  array  $formParams An associative array of charge data.
     * @return array
     */
    public function chargeZambiaMobileMoney($formParams)
    {
        return $this->chargePayment(self::ZAMBIA_MOBILE_MONEY_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer using USSD
     *
     * This payment method allows you to accept payments from your customers via USSD.
     *
     * @param  array  $formParams An associative array of charge data.
     * @return array
     */
    public function chargeUssd($formParams)
    {
        return $this->chargePayment(self::USSD_CHARGE_TYPE, $formParams);
    }

    /**
     * Charge a customer's payment using the specified payment method.
     *
     * @param  string  $paymentMethod The payment method to use.
     * @param  array  $formParams An associative array of charge data.
     */
    private function chargePayment(string $paymentMethod, array $formParams): array
    {
        $endpoint = sprintf('%s%s', $this->baseUri, self::CHARGE_ENDPOINT);

        $queryParams = [
            'type' => $paymentMethod,
        ];

        $chargeData = $this->makeRequest(
            method: 'POST',
            requestUrl: $endpoint,
            queryParams: $queryParams,
            formParams: $formParams,
            isJsonRequest: true
        );

        return $chargeData;
    }

    /**
     *   Encrypts an array payload using 3DES-24 encryption.
     *
     *   @param  array  $payload The payload to be encrypted.
     *   @return string The encrypted payload in base64 encoded format.
     *
     *   @throws InvalidConfigurationException If the encryption key is missing.
     */
    private function encryptPayload(array $payload)
    {
        $encryptionKey = $this->encryptionKey;

        if (! $encryptionKey) {
            throw new InvalidConfigurationException("The encryption key for `{$this->paymentGateway}` is missing. Please ensure that the `encryption_key` config key for `{$this->paymentGateway}` is set correctly.");
        }

        $encrypted = openssl_encrypt(json_encode($payload), 'DES-EDE3', $encryptionKey, OPENSSL_RAW_DATA);

        return base64_encode($encrypted);
    }
}
