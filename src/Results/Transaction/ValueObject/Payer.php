<?php

namespace OscarVha\PaypalApi\Results\Transaction\ValueObject;

use stdClass;

class Payer
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
    private string $name;

    /**
     * @var string|null
     */
    private ?string $city;

    /**
     * @var string|null
     */
    private ?string $countryCode;

    /**
     * @var string|null
     */
    private ?string $line;

    /**
     * @var string|null
     */
    private ?string $postalCode;

    /**
     * @param string|null $email
     * @param string|null $name
     * @param string|null $city
     * @param string|null $countryCode
     * @param string|null $line
     * @param string|null $postalCode
     */
    public function __construct(?string $accountId,
                                ?string $email,
                                ?string $name,
                                ?string $city,
                                ?string $countryCode,
                                ?string $line ,
                                ?string $postalCode )
    {
        $this->accountId = $accountId;
        $this->email = $email;
        $this->name = $name;
        $this->city = $city;
        $this->countryCode = $countryCode;
        $this->line = $line;
        $this->postalCode = $postalCode;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @return string|null
     */
    public function getLine(): ?string
    {
        return $this->line;
    }

    /**
     * @param stdClass $payerStd
     * @return Payer
     */
    public static function createFromStdClass(stdClass $payerStd): Payer
    {
        return new self(
            ($payerStd->account_id) ?? null,
            ($payerStd->email_address) ?? null,
            ($payerStd->payer_name->alternate_full_name) ?? null,
            ($payerStd->address->city) ?? null,
            ($payerStd->address->country_code) ?? null,
            ($payerStd->address->line1) ?? null,
            ($payerStd->address->postal_code) ?? null,

        );
    }

}
