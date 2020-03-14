<?php

namespace Pearl\Controllers\Interfaces;

interface IController
{

    public function getData(string $key, $default);

    public function renderPage(): void;

    public function canEnter(): bool;
}