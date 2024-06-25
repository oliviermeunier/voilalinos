<?php

namespace Config;

use App\User\UI\View\UserViewFactory;
use CodeIgniter\Config\BaseService;
use App\User\Infra\Config\UserServices as UserServicesConfig;

class Services extends BaseService
{
    public static function userService($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userService');
        }

        return UserServicesConfig::userService(false);
    }

    public static function createUserCommandValidator($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('createUserCommandValidator');
        }

        return UserServicesConfig::createUserCommandValidator(false);
    }

    public static function userViewFactory($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userViewFactory');
        }
        return new UserViewFactory();
    }
}
