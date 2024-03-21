<?php

namespace Misha\CnsLoyalty\src\controllers;

use Misha\CnsLoyalty\src\kernel\base\controllers\BaseControllers;
use Misha\CnsLoyalty\src\kernel\http\Response;
use Misha\CnsLoyalty\src\repositories\UserRepository;
use Misha\CnsLoyalty\src\services\GroupService;
use Misha\CnsLoyalty\src\services\UserServices;

class User extends BaseControllers
{
    private UserServices $service;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->service = new UserServices($this->userRepository);
    }

    public function getUserPermissions()
    {
        $userId = $this->request->get('userId', null);

        $result = $this->service->getUserPermissions((int) $userId);
        Response::json($result);
    }
}