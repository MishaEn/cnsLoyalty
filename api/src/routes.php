<?php

namespace Misha\CnsLoyalty\routes;

function routeList(): array
{
    return [
        'api' => [
            'v1' => [
                'POST' => [
                    'groups/users' => 'Group@addUser',
                ],
                'GET' => [
                    'groups/:groupId/users' => 'Group@getUsers',
                    'users/:userId/permissions' => 'User@getUserPermissions',
                ],
                'DELETE' => [
                    'groups/:groupId/users/:userId' => 'Group@deleteUser',
                ]
            ],
            'v2' => [
                // маршруты для разных версий api
            ]
        ],
        'web' => [
            // маршруты с фронта (надо расширять Request и Router)
        ]
    ];
}