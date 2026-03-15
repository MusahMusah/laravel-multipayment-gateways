<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Enums;

enum FlutterwaveChargeType: string
{
    case CARD = 'card';
    case BANK_TRANSFER = 'bank_transfer';
    case NG_ACCOUNT_DEBIT = 'debit_ng_account';
    case UK_ACCOUNT_DEBIT = 'debit_uk_account';
    case ACH_PAYMENT = 'ach_payment';
    case APPLE_PAY = 'applepay';
    case GOOGLE_PAY = 'googlepay';
    case FAWRY_PAY = 'fawry_pay';
    case PAYPAL = 'paypal';
    case MPESA = 'mpesa';
    case GHANA_MOBILE_MONEY = 'mobile_money_ghana';
    case UGANDA_MOBILE_MONEY = 'mobile_money_uganda';
    case FRANCOPHONE_MOBILE_MONEY = 'mobile_money_franco';
    case RWANDA_MOBILE_MONEY = 'mobile_money_rwanda';
    case ZAMBIA_MOBILE_MONEY = 'mobile_money_zambia';
    case USSD = 'ussd';
}
