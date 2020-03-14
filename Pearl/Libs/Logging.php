<?php


use Ds\Map;
use Monolog\Logger;

class Logging
{
    /***
     * @var Map
     */
    private static $channels;

    public static function init()
    {
        self::$channels = new \Ds\Map();
    }

    public static function getLogging(string $channel)
    {
        $logging = self::$channels->get($channel);
        if ($logging == null) {
            $logging = new Logger($channel);
            $logging->pushHandler(new StreamHandler(LOGS_DIR . 'debug.log', Logger::DEBUG));
            $logging->pushHandler(new StreamHandler(LOGS_DIR . 'error.log', Logger::ERROR));
            $logging->pushHandler(new StreamHandler(LOGS_DIR . 'warn.log', Logger::WARNING));
        }
        return $logging;
    }
}