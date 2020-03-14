<?php

namespace Pearl\Services;

use FastRoute;
use FastRoute\RouteCollector;
use Pearl\Controllers\Api;
use Pearl\Core;

class Routing
{
    private $dispatcher;
    private $core;
    private $logging;

    /**
     * Reference: https://github.com/nikic/FastRoute
     * Routing constructor.
     * @param Core $core
     */
    public function __construct(Core $core)
    {
        $this->core = $core;
        $this->logging = $core->getLogging('Routing');
        $this->dispatcher = FastRoute\cachedDispatcher(static function (RouteCollector $r) {
            $r->addGroup('/api', static function (RouteCollector $r) {

                $r->addGroup('/users', static function (RouteCollector $r) {
                    $r->addRoute('GET', '/listall', Api\Users\ListAll::class);
                    $r->addRoute('POST', '/add', Api\Users\Add::class);
                    $r->addRoute('GET', '/list', Api\Users\ListCidadao::class);
                    $r->addRoute('PUT', '/update', Api\Users\Update::class);
                    $r->addRoute('DELETE', '/delete', Api\Users\Delete::class);
                });
            });
        }, [
            'cacheFile' => CACHE_DIR . '/route.cache', /* required */
            'cacheDisabled' => DEBUG,
        ]);
    }


    public function renderPage(): void
    {
        $http_method = $_SERVER['REQUEST_METHOD'];
        $request_uri = $_SERVER['REQUEST_URI'];

        if (DEBUG) {
            $data = $_SERVER['REQUEST_URI'] . ' -- '
                . json_encode(array_merge($_GET, $_POST)) . "  \n\r";
            $this->logging->debug($data);
        }

        if (false !== $position = strpos($request_uri, '?')) {
            $request_uri = substr($request_uri, 0, $position);
        }
        $request_uri = rawurldecode($request_uri);

        $route_args = $this->dispatcher->dispatch($http_method, $request_uri);
        switch ($route_args[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                http_response_code(404);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $route_args[1];

                $data = array_merge($_POST, $_GET, $route_args[2]);
                /** @var IController $request */
                $request = new $handler($this->core, $data);
                $request->renderPage();
                break;
        }
    }

    public function leave($url): void
    {
        header('Location: ' . $url);
        exit;
    }

}