<?php

namespace Misha\CnsLoyalty\src\tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetUserPermission(): void
    {
        $client = new Client();
        $response = $client->get('http://localhost:8080/api/v1/users/1/permissions');

        $expected = [
            "status" => "success",
            "code" => 200,
            "msg" => "ok",
            "data" => [
                [
                    "name" => "send_messages",
                    "hasPermission" => "true"
                ],
                [
                    "name" => "service_api",
                    "hasPermission" => "false"
                ],
                [
                    "name" => "debug",
                    "hasPermission" => "false"
                ]
            ]
        ];

        $actual = json_decode($response->getBody(), true);
        $this->assertEquals($expected, $actual);
    }
}
