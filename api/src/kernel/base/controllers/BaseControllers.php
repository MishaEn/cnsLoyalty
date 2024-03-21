<?php

namespace Misha\CnsLoyalty\src\kernel\base\controllers;
;
use Misha\CnsLoyalty\src\kernel\http\Request;

class BaseControllers
{
    public Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function returnJSON(): void
    {
        echo 'json';
    }
}