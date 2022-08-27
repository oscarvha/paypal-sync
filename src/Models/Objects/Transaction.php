<?php

namespace OscarVha\PaypalApi\Models\Objects;

use Carbon\Carbon;
use OscarVha\PaypalApi\Config\RouteApi;
use OscarVha\PaypalApi\Exceptions\ApiInvalidRequestException;
use OscarVha\PaypalApi\Models\PaypalApi;

use OscarVha\PaypalApi\Results\Transaction\TransactionsResult;
use OscarVha\PaypalApi\Util\Curl;
use stdClass;

class Transaction extends PaypalApi
{

    /**
     * @return TransactionsResult
     */
    public function get(string $startDate, string $endDate, string $fields = 'all', int $pageSize = 250, $page = 1)
    {
       $startDate = Carbon::parse($startDate)->format('Y-m-d\TH:i:s\Z');
       $endDate = Carbon::parse($endDate)->setHours(23)->setMinutes(59)->setSeconds(59)->format('Y-m-d\TH:i:s\Z');

        $route = $this->generateRoute(RouteApi::TRANSACTION_ROUTE,[
            'start_date' => $startDate,
            'end_date' => $endDate,
            'fields' => $fields,
            'page_size' => $pageSize,
            'page' => $page
        ]);

        $results = Curl::callRoute($route,$this->token);
        $this->checkErrorResponse($results);

       return $this->parseResults($results);
    }

    public function getSingle()
    {

    }

    /**
     * @param stdClass $results
     * @return TransactionsResult
     */
    private function parseResults(stdClass $results): TransactionsResult
    {
       return TransactionsResult::createFromStdClass($results);
    }
}
