<?php

namespace App\User\UI\Controller;

use App\User\App\Command\CreateUserCommand;
use App\User\App\Command\DeleteUserCommand;
use App\User\App\Command\UpdateUserCommand;
use App\User\App\Query\ListUsersQuery;
use App\User\App\Validator\CreateUserCommandValidator;
use App\User\Domain\Service\UserService;
use App\User\Infra\Config\UserServices;
use App\User\Infra\Validation\UserValidation;
use App\User\UI\View\UserViewFactory;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class UserController extends ResourceController
{
    protected $format    = 'json';
    private const MAX_PER_PAGE = 25;

    private UserService $userService;
    private CreateUserCommandValidator $createUserCommandValidator;
    private UserViewFactory $userViewFactory;

    public function __construct()
    {
        $this->userService = UserServices::userService();
        $this->createUserCommandValidator = UserServices::createUserCommandValidator();
        $this->userViewFactory = Services::userViewFactory();
    }

    public function list()
    {
        $page = $this->request->getGet('page');
        $page = $page ? (int) $page : 1;

        $command = new ListUsersQuery($page, self::MAX_PER_PAGE);
        $users = $this->userService->listUsers($command);
        $count = $this->userService->countUsers();

        $listView = $this->userViewFactory->getListView($users, $count, self::MAX_PER_PAGE, $page);

        return $this->respond($listView);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        $command = new CreateUserCommand(
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $data['professionalStatus']
        );

        if (!$this->createUserCommandValidator->validate((array) $command, UserValidation::$rules, UserValidation::$messages)) {
            return $this->failValidationErrors($this->createUserCommandValidator->getErrors());
        }

        $user = $this->userService->createUser($command);
        $userView = $this->userViewFactory->getSingleView($user);

        return $this->respond($userView);
    }

    public function update($id = null)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $data = $this->request->getJson(true);
        $command = new UpdateUserCommand(
            $id,
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['phone'],
            $data['address'],
            $data['professionalStatus']
        );

        if (!$this->createUserCommandValidator->validate((array) $command, UserValidation::$rules, UserValidation::$messages)) {
            return $this->failValidationErrors($this->createUserCommandValidator->getErrors());
        }

        $user = $this->userService->updateUser($command);
        $userView = $this->userViewFactory->getSingleView($user);

        return $this->respond($userView);
    }

    public function delete($id = null)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $command = new DeleteUserCommand($id);
        $this->userService->deleteUser($command);

        return $this->respondDeleted();
    }
}
