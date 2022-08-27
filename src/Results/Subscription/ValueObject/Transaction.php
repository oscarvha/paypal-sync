<?php

namespace OscarVha\PaypalApi\Results\Subscription\ValueObject;

use Carbon\Carbon;
use Itgasmobi\PaypalApi\Results\Transaction\ValueObject\Amount;

/**
 *
 */
class Transaction
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $transactionStatus;

    /**
     * @var Amount
     */
    private Amount $totalAmount;

    /**
     * @var Amount
     */
    private Amount $feeAmount;

    /**
     * @var Amount
     */
    private Amount $netAmount;

    /**
     * @var Subscriber
     */
    private Subscriber $subscriber;

    /**
     * @var Carbon
     */
    private Carbon $dateTime;

    /**
     * @param string $id
     * @param string $transactionStatus
     * @param Amount $totalAmount
     * @param Amount $feeAmount
     * @param Amount $netAmount
     * @param Subscriber $subscriber
     * @param Carbon $dateTime
     */
    public function __construct(string $id,
                                string $transactionStatus,
                                Amount $totalAmount,
                                Amount $feeAmount,
                                Amount $netAmount,
                                Subscriber $subscriber,
                                Carbon $dateTime)
    {
        $this->id = $id;
        $this->transactionStatus = $transactionStatus;
        $this->totalAmount = $totalAmount;
        $this->feeAmount = $feeAmount;
        $this->netAmount = $netAmount;
        $this->subscriber = $subscriber;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTransactionStatus(): string
    {
        return $this->transactionStatus;
    }

    /**
     * @return Amount
     */
    public function getTotalAmount(): Amount
    {
        return $this->totalAmount;
    }

    /**
     * @return Amount
     */
    public function getFeeAmount(): Amount
    {
        return $this->feeAmount;
    }

    /**
     * @return Amount
     */
    public function getNetAmount(): Amount
    {
        return $this->netAmount;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber(): Subscriber
    {
        return $this->subscriber;
    }

    /**
     * @return Carbon
     */
    public function getDateTime(): Carbon
    {
        return $this->dateTime;
    }

    /**
     * @param $transaction
     * @return static
     */
    public static function crateFromStdClass($transaction) : self
    {

        $amounts = $transaction->amount_with_breakdown;

        return new self(
            $transaction->id,
            $transaction->status,
            new Amount($amounts->gross_amount->currency_code, $amounts->gross_amount->value),
            new Amount($amounts->fee_amount->currency_code, $amounts->fee_amount->value),
            new Amount($amounts->net_amount->currency_code, $amounts->net_amount->value),
            Subscriber::createFromStdClassAndEmail($transaction->payer_name, $transaction->payer_email),
            Carbon::parse($transaction->time)
        );
    }
}
