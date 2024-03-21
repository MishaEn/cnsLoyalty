<?php

require_once __DIR__ . '/vendor/autoload.php';

use Misha\CnsLoyalty\src\kernel\Api;

$api = Api::getInstance();
$api->run();