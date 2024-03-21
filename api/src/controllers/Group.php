<?php

namespace Misha\CnsLoyalty\src\controllers;

use Misha\CnsLoyalty\src\kernel\base\controllers\BaseControllers;
use Misha\CnsLoyalty\src\kernel\http\Response;
use Misha\CnsLoyalty\src\repositories\GroupRepository;
use Misha\CnsLoyalty\src\repositories\UserRepository;
use Misha\CnsLoyalty\src\services\GroupService;


class Group extends BaseControllers
{
    /**
     * @var GroupRepository
     */
    private GroupRepository $groupRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var GroupService
     */
    private GroupService $service;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->groupRepository = new GroupRepository();
        $this->userRepository = new UserRepository();
        $this->service = new GroupService($this->groupRepository, $this->userRepository);
    }

    /**
     * @return void
     */
    public function addUser(): void
    {
        $groupId = $this->request->get('groupId', null);
        $userId = $this->request->get('userId', null);

        $result = $this->service->addUser((int) $groupId, (int) $userId);
        Response::json($result);
    }

    /**
     * @throws \Exception
     */
    public function deleteUser(): void
    {
        $groupId = $this->request->get('groupId', null);
        $userId = $this->request->get('userId', null);

        $result = $this->service->deleteUser((int) $groupId, (int) $userId);
        Response::json($result);

    }

    /**
     * @throws \Exception
     */
    public function getUsers(): void
    {
        $groupId = $this->request->get('groupId', null);

        $result = $this->service->getUsers((int) $groupId);
        Response::json($result);
    }
}