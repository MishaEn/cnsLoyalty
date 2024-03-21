<?php

namespace Misha\CnsLoyalty\src\repositories;

use Misha\CnsLoyalty\src\kernel\base\repositories\MySQLRepository;

class GroupRepository extends MySQLRepository
{
    public function getAll(): ?array
    {
        $sql = /** @lang MySQL */
        <<<SQL
            SELECT * FROM `groups`
SQL;
        return $this->query($sql, []);
    }

    public function addUser(int $groupId, int $userId): array
    {
        $sql = /** @lang MySQL */
            <<<SQL
            INSERT INTO user_groups (user_id, groups_id) VALUES (:userId, :groupId)
SQL;
        return $this->query($sql, ['userId' => $userId, 'groupId' => $groupId]);
    }

    public function deleteUser(int $groupId, int $userId): array|bool
    {
        $sql = /** @lang MySQL */
            <<<SQL
            DELETE FROM user_groups WHERE groups_id = :groupId AND user_id = :userId
SQL;
        return $this->query($sql, ['userId' => $userId, 'groupId' => $groupId]);
    }

    public function getUsers(int $groupId): array
    {
        $sql = /** @lang MySQL */
            <<<SQL
            SELECT
                u.id as "userId",
                u.name as "userName"
            FROM
                user_groups ug
                LEFT JOIN users u ON u.id = ug.user_id
            WHERE
                ug.groups_id = :groupId
SQL;
        return $this->query($sql, ['groupId' => $groupId]);
    }
}
