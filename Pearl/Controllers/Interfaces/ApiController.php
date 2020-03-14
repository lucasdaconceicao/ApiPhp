<?php

namespace Pearl\Controllers\Interfaces;


use Pearl\Core;

abstract class ApiController implements IController
{
    private $data;
    private $core;

    public function __construct(Core $core, array $data)
    {
        $this->data = $data;
        $this->core = $core;
    }


    /**
     * This method is used to process request
     */
    public function renderPage(): void
    {
    }

    /**
     * This method will display the output for requests
     * @param $message
     * @return string
     */
    public function display($message): string
    {
        die(json_encode($message));
    }

    /**
     * This method check if the user who did the request can enter.
     * If want to allow anyone including non-logged users just return true
     * @return bool
     */
    public function canEnter(): bool
    {
        return true;
    }

    public function getCore(): Core
    {
        return $this->core;
    }

    /**
     * This method will return request POST and GET data
     * @param string $key
     * @param mixed $default default value if null
     * @return mixed|null
     */
    public function getData(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }


    public function getAllData(): array
    {
        return $this->data;
    }


}