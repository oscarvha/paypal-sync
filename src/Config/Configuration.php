<?php

namespace OscarVha\PaypalApi\Config;

class Configuration
{
    public const ENVIRONMENTS = 'environments';

    /**
     * @param string $file
     * @return array
     */
    public static function get(string $file): array
    {
        return include __DIR__.'/../../config/'.$file.'.php';
    }
}
