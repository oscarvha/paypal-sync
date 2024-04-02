<?php

namespace OscarVha\PaypalApi\Results\Subscription\ValueObject;


use OscarVha\PaypalApi\Results\Transaction\ValueObject\Payer;
use stdClass;

class Subscriber
{
    /**
     * @var string|null
     */
    private ?string $accountId;
    /**
     * @var string|null
     */
    private ?string $email;

    /**
     * @var string
     */
    private ?string $name;

    /**
     * @var string|null
     */
    private ?string $surname;

    /**
     * @param string|null $accountId
     * @param string|null $email
     * @param string|null $name
     * @param string|null $surname
     */
    public function __construct(?string $accountId,
                                ?string $email,
                                ?string $name,
                                ?string $surname)
    {
        $this->accountId = $accountId;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return string|null
     */
    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param stdClass $subscriber
     * @return Payer
     */
    public static function createFromStdClass(stdClass $subscriber): Subscriber
    {
        return new self(
            ($subscriber->payer_id) ?? null,
            ($subscriber->email_address) ?? null,
            ($subscriber->name->given_name) ?? null,
            ($subscriber->name->surname) ?? null
        );
    }

    /**
     * @param stdClass $subscriber
     * @return Payer
     */
    public static function createFromStdClassAndEmail(stdClass $subscriber , $email): Subscriber
    {



        return new self(
            ($subscriber->payer_id) ?? null,
            ($email) ?? null,
            ($subscriber->given_name) ?? null,
            ($subscriber->surname) ?? null
        );
    }

}
