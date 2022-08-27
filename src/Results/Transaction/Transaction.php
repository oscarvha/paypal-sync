<?php

namespace Itgasmobi\PaypalApi\Results\Transaction;

use OscarVha\PaypalApi\Results\Transaction\ValueObject\Amount;
use OscarVha\PaypalApi\Results\Transaction\ValueObject\Code;
use OscarVha\PaypalApi\Results\Transaction\ValueObject\Fee;
use OscarVha\PaypalApi\Results\Transaction\ValueObject\Payer;
use stdClass;

class Transaction
{
    private string $id;

    private string $transactionStatus;

    private string|null $transactionSubject;

    private string $initialDate;

    private string $updatedDate;

    private Amount|null $amount;

    private Fee|null $fee;

    private Payer|null $payer;

    private Code $code;

    /**
     * @param string $id
     * @param string $transactionStatus
     * @param string $initialDate
     * @param string $updatedDate
     * @param Amount|null $amount
     * @param Fee|null $fee
     * @param Payer|null $payer
     */
    public function __construct(string $id,
                                string $transactionStatus,
                                ?string $transactionSubject,
                                string $initialDate,
                                string $updatedDate,
                                ?Amount $amount,
                                ?Fee $fee,
                                ?Payer $payer, Code $code)
    {
        $this->id = $id;
        $this->transactionStatus = $transactionStatus;
        $this->transactionSubject = $transactionSubject;
        $this->initialDate = $initialDate;
        $this->updatedDate = $updatedDate;
        $this->amount = $amount;
        $this->fee = $fee;
        $this->payer = $payer;
        $this->code = $code;
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
     * @return string
     */
    public function getInitialDate(): string
    {
        return $this->initialDate;
    }

    /**
     * @return string
     */
    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    /**
     * @return Amount|null
     */
    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    /**
     * @return Fee|null
     */
    public function getFee(): ?Fee
    {
        return $this->fee;
    }

    /**
     * @return Payer|null
     */
    public function getPayer(): ?Payer
    {
        return $this->payer;
    }

    /**
     * @return Code
     */
    public function getCode(): Code
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getTransactionSubject(): ?string
    {
        return $this->transactionSubject;
    }


    /**
     * @param stdClass $transactionStd
     * @return Transaction
     */
    public static function createFromStdClass(stdClass $transactionStd): Transaction
    {
        $transactionInfo = $transactionStd->transaction_info;

        $amount = null;

        if($transactionInfo->transaction_amount) {
            $amount = new Amount($transactionInfo->transaction_amount->currency_code,
                (float)$transactionInfo->transaction_amount->value);
        }

        $fee = null;

        if(isset($transactionInfo->fee_amount)) {
            $fee = new Fee($transactionInfo->fee_amount->currency_code, (float)$transactionInfo->fee_amount->value);
        }

        $payer = null;

        if(isset($transactionStd->payer_info, $transactionStd->payer_info->email_address)) {
            $payer = Payer::createFromStdClass($transactionStd->payer_info);
        }

        $transactionCode = new Code($transactionInfo->transaction_event_code);

        return new self(
            $transactionInfo->transaction_id,
            $transactionInfo->transaction_status,
            ($transactionInfo->transaction_subject) ?? null,
            $transactionInfo->transaction_initiation_date,
            $transactionInfo->transaction_updated_date,
            $amount,
            $fee,
            $payer,
            $transactionCode
        );

    }

}
