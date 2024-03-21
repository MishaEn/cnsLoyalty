<?php

namespace Misha\CnsLoyalty\src\kernel;

use Misha\CnsLoyalty\src\kernel\base\factory\ControllerFactory;
use Misha\CnsLoyalty\src\kernel\http\Response;

class Api
{
    /**
     * @var api|null
     */
    private static ?api $instance = null;
    public Response $response;

    /**
     * @return void
     */
    private function __constructor()
    {
    }

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        return self::$instance ?? new static();
    }

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $router = new Router();

            $controllerName = $router->getController();
            $actionName = $router->getAction();
            $controller = ControllerFactory::build($controllerName);
            $controller->$actionName();
        } catch (\PDOException $e) {
            Response::dbError();
        } catch (\Exception $e) {
            Response::notFound();
        }
    }
}