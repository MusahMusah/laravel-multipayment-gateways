<?php

namespace MusahMusah\LaravelMultipaymentGateways\Constants;

class FlutterwaveConstant
{
    const CHARGE_ENDPOINT = '/charges/';

    const BANK_ENDPOINT = '/banks/';

    const OTP_ENDPOINT = '/otps/';

    const PAYMENT_PLAN_ENDPOINT = '/payment-plans/';

    const SETTLEMENT_ENDPOINT = '/settlements/';

    const SUBSCRIPTION_ENDPOINT = '/subscriptions/';

    const TRANSACTION_ENDPOINT = '/transactions/';

    const REFUND_ENDPOINT = '/refunds/';

    const BENEFICIARY_ENDPOINT = '/beneficiaries/';

    const TRANSFER_ENDPOINT = '/transfers/';

    const BULK_TRANSFER_ENDPOINT = '/bulk-transfers/';

    const VALIDATE_CHARGE_ENDPOINT = '/validate-charge';

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
}
