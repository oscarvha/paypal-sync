<?php

namespace Itgasmobi\PaypalApi\Results\Transaction;




class TransactionsResult
{
    private string $accountId;

    private string $startDate;

    private string $endDate;

    private int $page;

    private int $totalItems;

    private int $totalPage;

    private array $transactions;

    /**
     * @param string $accountDetails
     * @param string $startDate
     * @param string $endDate
     * @param int $page
     * @param int $totalItems
     * @param int $totalPage
     * @param array $transactions
     */
    public function __construct(string $accountDetails, string $startDate, string $endDate, int $page, int $totalItems, int $totalPage, array $transactions)
    {
        $this->accountId = $accountDetails;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->page = $page;
        $this->totalItems = $totalItems;
        $this->totalPage = $totalPage;
        $this->transactions = $transactions;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return int
     */
    public function getTotalPage(): int
    {
        return $this->totalPage;
    }

    /**
     * @return array<Transaction>
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public static function createFromStdClass(\stdClass $result)
    {
        $transactions = [];

        foreach ($result->transaction_details as $transaction) {
            $transactions[] = Transaction::createFromStdClass($transaction);
         }

        return new self(
            $result->account_number,
            $result->start_date,
            $result->end_date,
            $result->page,
            $result->total_items,
            $result->total_pages,
            $transactions
        );
    }


}
