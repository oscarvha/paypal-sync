<?php

namespace OscarVha\PaypalApi\Results\Transaction\ValueObject;

class CodeType
{
     public const GENERAL_PAYMENT_CODE = 'T0000';
     public const GENERAL_PAYMENT = [
        'name' => 'General Payment',
        'category' => 'General payment'
    ];

    public const GENERAL_ACCOUNTING_TRANSFER_CODE = 'T2000';
    public const GENERAL_ACCOUNTING_TRANSFER = [
        'name' => 'General intraaccount transfer',
        'category' => 'Account Transfer'
    ];

    public const GENERAL_CURRENCY_CONVERSION_CODE = 'T0200';
    public const GENERAL_CURRENCY_CONVERSION  = [
        'name' => 'General Currency Conversion',
        'category' => 'Currency Conversion'
    ];

    public const PRE_APPROVED_PAYMENT_BILL_USER_CODE = 'T0003';
    public const PRE_APPROVED_PAYMENT_BILL_USER  = [
        'name' => 'PreApproved Payment Bill User Payment',
        'category' => 'Payment Bill User Payment'
    ];

    public const BANK_DEPOSIT_TO_PP_ACCOUNT_CODE = 'T0300';
    public const BANK_DEPOSIT_TO_PP_ACCOUNT  = [
        'name' => 'PreApproved Payment Bill User Payment',
        'category' => 'Payment Bill User Payment'
    ];

    public const MASS_PAY_PAYMENT_CODE = 'T0001';
    public const MASS_PAY_PAYMENT  = [
        'name' => 'PreApproved Payment Bill User Payment',
        'category' => 'Payment Bill User Payment'
    ];

    public const GENERAL_CREDIT_CARD_DEPOSIT_CODE = 'T0700';
    public const GENERAL_CREDIT_CARD_DEPOSIT  = [
        'name' => 'General Credit Card Deposit',
        'category' => 'General Credit Card Deposit'
    ];

    public const CHECKOUT_API_CODE = 'T0006';
    public const CHECKOUT_API = [
        'name' => 'PayPal Checkout APIs.',
        'category' => 'PayPal account-to-PayPal account payment'
    ];


    public const MESSAGES = [
        self::GENERAL_PAYMENT_CODE => self::GENERAL_PAYMENT,
        self::GENERAL_ACCOUNTING_TRANSFER_CODE => self::GENERAL_ACCOUNTING_TRANSFER,
        self::GENERAL_CURRENCY_CONVERSION_CODE => self::GENERAL_CURRENCY_CONVERSION,
        self::PRE_APPROVED_PAYMENT_BILL_USER_CODE => self::PRE_APPROVED_PAYMENT_BILL_USER,
        self::BANK_DEPOSIT_TO_PP_ACCOUNT_CODE => self::BANK_DEPOSIT_TO_PP_ACCOUNT,
        self::MASS_PAY_PAYMENT_CODE => self::MASS_PAY_PAYMENT,
        self::GENERAL_CREDIT_CARD_DEPOSIT_CODE => self::GENERAL_CREDIT_CARD_DEPOSIT,
        self::CHECKOUT_API_CODE => self::CHECKOUT_API
    ];




    public static function getName(string $code)
    {
        return isset(self::MESSAGES[$code]) ? self::MESSAGES[$code]['name'] : '';

    }

    /**
     * @param string $code
     * @return string[]
     */
    public static function getCategory(string $code)
    {
        return isset(self::MESSAGES[$code]) ? self::MESSAGES[$code]['name'] : '';

    }


}
