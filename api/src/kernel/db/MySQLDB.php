<?php

namespace Misha\CnsLoyalty\src\kernel\db;

use Exception;
use mysqli;
use PDO;
use PDOException;

class MySQLDB
{
    private static ?MySQLDB $instance = null;

    private bool $isConnect = false;
    private PDO $pdo;

    /**
     * @throws Exception
     */
    private function __construct($host, $username, $password, $database)
    {
    }

    /**
     * @throws Exception
     */
    public static function getInstance($host, $username, $password, $database): ?MySQLDB
    {
        self::$instance = self::$instance ?? new static($host, $username, $password, $database);

        if (!self::$instance->isConnect) {
            self::$instance->connect($host, $username, $password, $database);
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    private function connect($host, $username, $password, $database): void
    {
        $dsn = 'mysql:host=' . $host . ';port=3306;dbname=' . $database . ';';

        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }
}