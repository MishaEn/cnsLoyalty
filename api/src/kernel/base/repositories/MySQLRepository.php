<?php

namespace Misha\CnsLoyalty\src\kernel\base\repositories;

use Misha\CnsLoyalty\src\kernel\db\MySQLDB;
use PDO;
use PDOException;

class MySQLRepository
{
    private MySQLDB $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = MySQLDB::getInstance('mysql_db', 'root', 'pass', 'test');
    }

    public function query(string $sql, array $params): array|bool
    {
        $result = [];

        try {
            $stmt = $this->db->pdo()->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Ошибка запроса: " . $e->getMessage();
        }

        return $result;
    }
}