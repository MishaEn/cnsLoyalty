<?php

namespace Misha\CnsLoyalty\src\tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class GroupsTest extends TestCase
{
    public function testAddUserInGroup(): void
    {
        $client = new Client();
        $response = $client->post('http://localhost:8080/api/v1/groups/users', [
            'form_params' => [
                'groupId' => '1',
                'userId' => '2',
            ]
        ]);

        $expected = [
            'status' => 'success',
            'code' => 200,
            'msg' => 'ok',
        ];

        $actual = json_decode($response->getBody(), true);
        $this->assertEquals($expected, $actual);
    }

    public function testDeleteUserFromGroup(): void
    {
        $client = new Client();
        $response = $client->delete('http://localhost:8080/api/v1/groups/1/users/2');

        $expected = [
            'status' => 'success',
            'code' => 200,
            'msg' => 'ok',
        ];

        $actual = json_decode($response->getBody(), true);
        $this->assertEquals($expected, $actual);
    }

    public function testGetUserFromGroup(): void
    {
        $client = new Client();
        $response = $client->get('http://localhost:8080/api/v1/groups/1/users');

        $expected = [
            'status' => 'success',
            'code' => 200,
            'msg' => 'ok',
            'data' => [
                [
                    'userId' => 1,
                    "userName" => "Vasya"
                ],
            ]
        ];

        $actual = json_decode($response->getBody(), true);
        $this->assertEquals($expected, $actual);
    }
}