<?php

namespace OscarVha\PaypalApi\Results\Transaction\ValueObject;

/**
 *
 */
class Amount
{
    /**
     *
     */
    private const TYPE_PAY = 'pay';

    /**
     *
     */
    private const TYPE_RECEIVE ='receive';

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var float
     */
    private float $value;

    /**
     * @var string
     */
    private string $type;

    /**
     * @param string $currency
     * @param float $value
     */
    public function __construct(string $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
        $this->setType($value);
    }

    /**
     * @param float $value
     * @return void
     */
    private function setType(float $value): void
    {
        if($value >= 0) {
            $this->type = self::TYPE_RECEIVE;
            return;
        }

        $this->type = self::TYPE_PAY;
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }




}
