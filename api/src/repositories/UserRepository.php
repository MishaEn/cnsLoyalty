<?php

namespace Misha\CnsLoyalty\src\repositories;

use Misha\CnsLoyalty\src\kernel\base\repositories\MySQLRepository;

class UserRepository extends MySQLRepository
{
    public function getUserPermissions(int $userId): ?array
    {
        $sql = /** @lang MySQL */
            <<<SQL
            SELECT 
                p.name,
                CASE
                    WHEN hasPermission.permission_id IS NOT NULL AND bu.id IS NULL
                    THEN  'true'
                    ELSE 'false'
                END AS "hasPermission"
            FROM 
                permissions p
                LEFT JOIN blocked_user bu ON bu.permission_id = p.id AND bu.user_id = :userId
                JOIN LATERAL (
                    SELECT
                        pg.permission_id
                    FROM
                        user_groups ug
                        LEFT JOIN permission_groups pg ON pg.groups_id = ug.groups_id AND pg.permission_id = p.id
                    WHERE ug.user_id = :userId
                ) hasPermission
SQL;
        return $this->query($sql, ['userId' => $userId]);
    }
}