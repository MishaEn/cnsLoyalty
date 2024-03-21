<?php

namespace Misha\CnsLoyalty\src\kernel\http;

use JetBrains\PhpStorm\NoReturn;
use function MyNamespace\empty1;

class Response
{
    private const int STATUS_OK = 200;
    private const int STATUS_NOT_FOUND = 404;
    private const int STATUS_SERVER_ERROR = 500;

    public static function json($data): void
    {
        $response = ['status' => 'success', 'code' => self::STATUS_OK, 'msg' => 'ok'];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        header('Content-Type: application/json');
        http_response_code(self::STATUS_OK);
        echo json_encode($response);
        exit;
    }

    public static function notFound(): void
    {
        http_response_code(self::STATUS_NOT_FOUND);
        exit;
    }
    public static function dbError(): void
    {
        http_response_code(self::STATUS_SERVER_ERROR);
        exit;
    }
}