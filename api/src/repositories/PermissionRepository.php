<?php

namespace Misha\CnsLoyalty\src\repositories;

use Misha\CnsLoyalty\src\kernel\base\repositories\MySQLRepository;

class PermissionRepository extends MySQLRepository
{
    public function getAll()
    {
        $sql = /** @lang MySQL */
            <<<SQL
            SELECT 
                *
            FROM 
                permissions p
                
SQL;
        return $this->query($sql, []);
    }
}