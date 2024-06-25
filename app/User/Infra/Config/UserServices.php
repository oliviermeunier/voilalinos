<?php

namespace App\User\Infra\Config;

use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Infra\Repository\MySQLUserRepository;
use App\User\Domain\Service\UserService;
use App\User\App\Validator\CreateUserCommandValidator;
use App\User\Infra\Service\SymfonyUuidManager;
use App\User\UI\View\UserViewFactory;
use CodeIgniter\Config\BaseService;
use Config\Database;
use Config\Services;

class UserServices extends BaseService
{
    public static function userRepository($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }
        $db = Database::connect();
        return new MySQLUserRepository($db);
    }

    public static function userService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return new UserService(
            static::userRepository(false),
            static::uuidManager(false)
        );
    }

    public static function createUserCommandValidator($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('createUserCommandValidator');
        }

        return new CreateUserCommandValidator(Services::validation());
    }

    public static function uuidManager($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('uuidManager');
        }
        return new SymfonyUuidManager();
    }
}
