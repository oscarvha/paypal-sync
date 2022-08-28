<?php

namespace OscarVha\PaypalApi\Results\Subscription;


use OscarVha\PaypalApi\Results\Subscription\ValueObject\Cycle;
use OscarVha\PaypalApi\Results\Subscription\ValueObject\LastPayment;
use OscarVha\PaypalApi\Results\Subscription\ValueObject\Subscriber;
use OscarVha\PaypalApi\Results\Subscription\ValueObject\Transaction;
use stdClass;

/**
 *
 */
/**
 *
 */
class Subscription
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string
     */
    private string $planId;

    /**
     * @var string
     */
    private string $initialDate;

    /**
     * @var string
     */
    private string $updatedDate;

    /**
     * @var Subscriber|null
     */
    private Subscriber|null $subscriber;

    /** @var Cycle[] */
    private array $cycles;

    /** @var string|null */
    private ?string $nextPaymentDate;

    /**
     * @var LastPayment|null
     */
    private LastPayment|null $lastPayment;

    /** @var Transaction[] */
    private array $transactions;

    /**
     * @param string $id
     * @param string $status
     * @param string $planId
     * @param string $initialDate
     * @param string $updatedDate
     * @param string|null $nextPaymentDate
     * @param Subscriber|null $subscriber
     * @param array $cycles
     * @param LastPayment|null $lastPayment
     * @param array $transactions
     */
    public function __construct(string $id,
                                string $status,
                                string $planId,
                                string $initialDate,
                                string $updatedDate,
                                ?string $nextPaymentDate,
                                ?Subscriber $subscriber,
                                array $cycles,
                                ?LastPayment $lastPayment,
                                array $transactions)
    {
        $this->id = $id;
        $this->status = $status;
        $this->planId = $planId;
        $this->initialDate = $initialDate;
        $this->updatedDate = $updatedDate;
        $this->$nextPaymentDate = $nextPaymentDate;
        $this->subscriber = $subscriber;
        $this->cycles = $cycles;
        $this->lastPayment = $lastPayment;
        $this->transactions = $transactions;
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
    public function getStatus(): string
    {
        return $this->status;
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
     * @return Subscriber|null
     */
    public function getSubscriber(): ?Subscriber
    {
        return $this->subscriber;
    }

    /**
     * @return array
     */
    public function getCycles(): array
    {
        return $this->cycles;
    }

    /**
     * @return LastPayment|null
     */
    public function getLastPayment(): ?LastPayment
    {
        return $this->lastPayment;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @return string
     */
    public function getPlanId(): string
    {
        return $this->planId;
    }


    /**
     * @return string
     */
    public function getNextPaymentDate(): string
    {
        return $this->nextPaymentDate;
    }


    /**
     * @param stdClass $subscription
     * @param array $transactions
     * @return Subscription
     */
    public static function createFromStdClass(stdClass $subscription , array $transactions): Subscription
    {

        $subscriber = null;

        if(isset($subscription->subscriber, $subscription->subscriber->email_address)) {
            $subscriber = Subscriber::createFromStdClass($subscription->subscriber);
        }

        $cycles = [];

        if(isset($subscription->billing_info->cycle_executions)) {
            foreach($subscription->billing_info->cycle_executions as $cycle) {
                $cycles[] = Cycle::createFromStdClass($cycle);
            }
        }


        $lastPayment = null;

        if(isset($subscription->billing_info->last_payment)) {
            $lastPayment = LastPayment::createFromStdClass($subscription->billing_info->last_payment);
        }

        return new self(
            $subscription->id,
            $subscription->status,
            $subscription->plan_id,
            $subscription->start_time,
            $subscription->update_time,
            $subscription->billing_info->next_billing_time,
            $subscriber,
            $cycles,
            $lastPayment,
            $transactions
        );

    }

}
