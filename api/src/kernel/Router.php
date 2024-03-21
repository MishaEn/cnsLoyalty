<?php

namespace Misha\CnsLoyalty\src\kernel;

use Misha\CnsLoyalty\src\kernel\http\Request;
use function Misha\CnsLoyalty\routes\routeList;
class Router
{
    /**
     * @var string
     */
    private string $prefix;
    /**
     * @var string|null
     */
    private ?string $version;
    /**
     * @var string
     */
    private string $method;
    /**
     * @var array
     */
    private array $requestPath;
    /**
     * @var Request
     */
    private Request $request;
    /**
     * @var array
     */
    private array $routeList;
    /**
     * @var string
     */
    private string $controller;
    /**
     * @var string
     */
    private string $action;

    /**
     *
     */
    public function __construct()
    {
        $this->request = Request::getInstance();

        $this->routeList = routeList();
        $this->prefix = $this->request->getPrefix();
        $this->version = $this->request->getVersion();
        $this->method = $this->request->getMethod();
        $this->requestPath = $this->request->getRoute();

        $this->route();
    }

    /**
     * @throws \Exception
     */
    private function route(): void
    {
        $needleRoute = null;
        $params = [];

        $routes = $this->routeList[$this->prefix][$this->version][$this->method] ?? null;

        if ($routes === null) {
            throw new \Exception();
        }

        foreach ($routes as $routeKey => $route) {
            $routePath = explode('/', $routeKey);

            if (count($this->requestPath) !== count($routePath)) {
                continue;
            }

            $params = $this->method === 'POST' ? $_POST : [];
            $needleRoute = null;
            $match = false;

            foreach ($routePath as $itemKey => $routeItem) {
                $match = !str_starts_with($routeItem, ':') && $this->requestPath[$itemKey] === $routeItem;

                if (str_starts_with($routeItem, ':')) {
                    $params[substr($routeItem,1)] = $this->requestPath[$itemKey];
                }
            }

            if ($match) {
                $needleRoute = $routeKey;
                break;
            }
        }

        if ($needleRoute === null) {
            throw new \Exception();
        }

        $this->request->setParameters($params);

        $endPoint = explode('@', $routes[$needleRoute]);

        $this->controller = $endPoint[0];
        $this->action = $endPoint[1];
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

}