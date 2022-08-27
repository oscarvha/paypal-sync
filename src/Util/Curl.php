<?php

namespace OscarVha\PaypalApi\Util;

use Dflydev\DotAccessData\Data;
use OscarVha\PaypalApi\Exceptions\EmptyCurlResponseException;
use JsonException;

class Curl
{
    /**
     * @throws EmptyCurlResponseException
     * @throws JsonException
     */
    public static function callWithUserPWD(string $url, string $client, string $secret)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($ch);

        if(empty($result)) {
            throw new EmptyCurlResponseException();
        }

        return json_decode($result, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $url
     * @param string $token
     * @return mixed
     * @throws JsonException
     */
    public static function callRoute(string $url , string $token): mixed
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer '.$token,
                'Accept: application/json',
                'Content-Type: application/json'
            ]
        ]);


        $result = curl_exec($curl);


        curl_close($curl);

        return json_decode($result, false, 512, JSON_THROW_ON_ERROR);
    }
}
