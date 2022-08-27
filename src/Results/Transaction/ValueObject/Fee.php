<?php

namespace OscarVha\PaypalApi\Results\Transaction\ValueObject;

/**
 *
 */
class Fee
{
    /**
     * @var string
     */
    private string $currency;

    /**
     * @var float
     */
    private float $value;

    /**
     * @param string $currency
     * @param float $value
     */
    public function __construct(string $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

}
