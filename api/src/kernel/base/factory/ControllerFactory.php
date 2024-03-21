<?php

namespace Misha\CnsLoyalty\src\kernel\base\factory;

use Misha\CnsLoyalty\src\kernel\http\Request;

class ControllerFactory
{
    public static function build(string $controllerName): object
    {
        $request = Request::getInstance();

        $className = '\\Misha\\CnsLoyalty\\src\\controllers\\' . $controllerName;

        return new $className($request);
    }
}