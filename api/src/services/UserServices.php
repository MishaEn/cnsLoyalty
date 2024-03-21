<?php

namespace Misha\CnsLoyalty\src\services;

use Misha\CnsLoyalty\src\repositories\PermissionRepository;
use Misha\CnsLoyalty\src\repositories\UserRepository;

class UserServices
{
    private UserRepository $repository;
    private PermissionRepository $permissionRepository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->permissionRepository = new PermissionRepository();
    }

    public function getUserPermissions(int $userId): array
    {
        return $this->repository->getUserPermissions($userId);
    }
}