<?php

namespace OscarVha\PaypalApi\Models\Objects;

use Carbon\Carbon;
use OscarVha\PaypalApi\Config\RouteApi;

use OscarVha\PaypalApi\Exceptions\ApiInvalidRequestException;
use OscarVha\PaypalApi\Models\PaypalApi;
use OscarVha\PaypalApi\Util\Curl;
use JsonException;
use stdClass;


/**
 *
 */
class Subscription extends PaypalApi
{
    /**
     * @param string $subscriptionId
     * @return \OscarVha\PaypalApi\Results\Subscription\Subscription
     * @throws JsonException
     * @throws ApiInvalidRequestException
     */
    public function get(string $subscriptionId)
    {
        $route = $this->generateRoute(RouteApi::SUBSCRIPTION_ROUTE.$subscriptionId,[
        ]);

        $results = Curl::callRoute($route,$this->token);

         $this->checkErrorResponse($results);

         return $this->parseResults($results);


    }

    /**
     * @param string $subscriptionId
     * @param string $startDate
     * @param string $endDate
     * @return \OscarVha\PaypalApi\Results\Subscription\Subscription
     * @throws ApiInvalidRequestException
     * @throws JsonException
     */
    public function getWithTransactions(string $subscriptionId, string $startDate, string $endDate): \OscarVha\PaypalApi\Results\Subscription\Subscription
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d\TH:i:s\Z');
        $endDate = Carbon::parse($endDate)->setHours(23)->setMinutes(59)->setSeconds(59)->format('Y-m-d\TH:i:s\Z');

        $route = $this->generateRoute(RouteApi::SUBSCRIPTION_ROUTE.$subscriptionId,[
        ]);

        $results = Curl::callRoute($route,$this->token);

        $this->checkErrorResponse($results);

        $transactions = $this->getTransactions($startDate, $endDate, $subscriptionId);

        return $this->parseResults($results , $transactions);
    }

    /**
     * @param stdClass $results
     * @param array $transactions
     * @return \OscarVha\PaypalApi\Results\Subscription\Subscription
     */
    private function parseResults(stdClass $results , array $transactions  = []) : \Oscarvha\PaypalApi\Results\Subscription\Subscription
    {
       return \OscarVha\PaypalApi\Results\Subscription\Subscription::createFromStdClass($results ,$transactions);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $subscriptionId
     * @return array
     * @throws JsonException
     */
    private function getTransactions(string $startDate, string $endDate, string $subscriptionId ): array
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d\TH:i:s\Z');
        $endDate = Carbon::parse($endDate)->setHours(23)->setMinutes(59)->setSeconds(59)->format('Y-m-d\TH:i:s\Z');

        $route = str_replace('{subscription_id}',$subscriptionId,$this->generateRoute(RouteApi::TRANSACTION_SUBSCRIPTION_ROUTE,[
            'start_time' => $startDate,
            'end_time' => $endDate,
        ]));



        $results = Curl::callRoute($route,$this->token);

        $transactions = [];
        foreach ($results as $transactionGroup) {
            foreach ($transactionGroup as $transaction) {

                if(!isset($transaction->id)) {
                 continue;
                }
                $transactions[] = \OscarVha\PaypalApi\Results\Subscription\ValueObject\Transaction::crateFromStdClass($transaction);

            }
        }

        return $transactions;

    }
}
