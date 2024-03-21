<?php

namespace Misha\CnsLoyalty\src\kernel\http\interfaces;

interface RequestInterface
{
    public static function getInstance(): self;
    public function get(string $parameter, mixed $default): mixed;
}