<?php

namespace Pearl;

use Illuminate\Database\Capsule\Manager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pearl\Services\Routing;
use Pearl\Services\Cidadaos;

class Core
{
    private $route;
    private $cidadaos;

    public function __construct()
    {
        $capsule = new Manager();
        $capsule->addConnection(MYSQL_SETTINGS);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $this->route = new Routing($this);
    }

    public function getCidadaos(): Cidadaos
    {
        if ($this->cidadaos === null) {
            $this->cidadaos = new Cidadaos();
        }
        return $this->cidadaos;
    }

    public function getRoute(): Routing
    {
        return $this->route;
    }

    public function getLogging(string $channel): Logger
    {
        $logging = new Logger($channel);
        if (DEBUG) {
            $logging->pushHandler(new StreamHandler(LOGS_DIR . 'debug.log', Logger::DEBUG));
        }
        $logging->pushHandler(new StreamHandler(LOGS_DIR . 'error.log', Logger::ERROR));
        $logging->pushHandler(new StreamHandler(LOGS_DIR . 'warn.log', Logger::WARNING));
        return $logging;
    }

}