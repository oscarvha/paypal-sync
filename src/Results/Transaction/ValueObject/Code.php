<?php

namespace OscarVha\PaypalApi\Results\Transaction\ValueObject;

class Code
{
    /**
     * @var string
     */
    private string $code;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var string
     */
    private string $category;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
        $this->setMessageAndCategory($code);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $code
     * @return void
     */
    private function setMessageAndCategory(string $code)
    {

        $this->message = CodeType::getName($code);
        $this->category = CodeType::getCategory($code);
    }


}
