<?php

namespace OscarVha\PaypalApi\Results\Subscription\ValueObject;

use Itgasmobi\PaypalApi\Results\Transaction\ValueObject\Amount;
use stdClass;

/**
 *
 */
class LastPayment
{
    /**
     * @var Amount
     */
    private Amount $amount;

    /**
     * @var string
     */
    private string $dateTime;

    /**
     * @param Amount $amount
     * @param string $dateTime
     */
    public function __construct(Amount $amount, string $dateTime)
    {
        $this->amount = $amount;
        $this->dateTime = $dateTime;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }


    /**
     * @param stdClass $stdClass
     * @return static
     */
    public static function createFromStdClass(stdClass $stdClass): self
    {
        $amount = new Amount($stdClass->amount->currency_code, $stdClass->amount->value);
        return new self(
            $amount,
            $stdClass->time
        );
    }

}
