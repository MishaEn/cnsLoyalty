<?php

namespace Misha\CnsLoyalty\src\kernel\http;

use Misha\CnsLoyalty\src\kernel\http\interfaces\RequestInterface;

class Request implements RequestInterface
{
    private string $method;
    private array $parameters = [];
    private string $prefix;
    private ?string $version;
    private array $route;
    private bool $isInit = false;
    private static ?Request $instance = null;

    /**
     * @return void
     */
    private function __constructor(): void
    {
    }

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        self::$instance = self::$instance ?? new static();

        if (!self::$instance->isInit) {
            self::$instance->init();
        }

        return self::$instance;
    }

    private function init(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $uriParts = explode('/', $uri);

        $this->prefix = $uriParts[1];
        $this->version = $uriParts[2] ?? null;

        unset($uriParts[0]);
        unset($uriParts[1]);
        unset($uriParts[2]);

        $uriParts = array_values($uriParts);

        $this->route = $uriParts;

        $this->isInit = true;
    }

    public function get(string $parameter, mixed $default): mixed
    {
        $needle = $default;

        if (array_key_exists($parameter, $this->parameters)) {
            $needle = $this->parameters[$parameter];
        }

        return $needle;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function getRoute(): array
    {
        return $this->route;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }
}