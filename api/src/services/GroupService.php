<?php

namespace Misha\CnsLoyalty\src\services;

use Misha\CnsLoyalty\src\repositories\GroupRepository;
use Misha\CnsLoyalty\src\repositories\UserRepository;

class GroupService
{
    private GroupRepository $groupRepository;
    private UserRepository $userRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    public function addUser(int $groupId, int $userId): array
    {
        return $this->groupRepository->addUser($groupId, $userId);
    }

    public function deleteUser(int $groupId, int $userId): array
    {
        return $this->groupRepository->deleteUser($groupId, $userId);
    }

    public function getUsers(int $groupId): array
    {
        return $this->groupRepository->getUsers($groupId);
    }
}