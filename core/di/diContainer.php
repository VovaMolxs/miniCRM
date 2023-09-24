<?php

namespace Core\di;

use App\Controllers\auth\AuthController;
use App\Controllers\IndexController;
use App\Controllers\roles\RoleController;
use App\Controllers\users\UsersController;
use App\Models\auth\AuthModel;
use App\Models\roles\RoleModel;
use App\Models\users\UserModel;
use Core\AbstractCore;

class diContainer extends AbstractCore
{
    private static $instance = null;
    private array $objects = [];


    public static function getInstance()
    {
        if (!self::$instance) {
            return self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($class) {
        return $this->objects[$class]();
    }


    public function init()
    {
        $this->objects = [
            IndexController::class => function() {
                return new IndexController();
            },
            UsersController::class => function () {
                return new UsersController(
                    $this->get(UserModel::class),
                    $this->get(RoleModel::class)
                );
            },
            RoleController::class => function () {
                return new RoleController(
                  $this->get(RoleModel::class)
                );
            },
            AuthController::class => function () {
                return new AuthController(
                    $this->get(AuthModel::class)
                );
            },
            UserModel::class => function () {
                return new UserModel();
            },
            RoleModel::class => function () {
                return new RoleModel();
            },
            AuthModel::class => function () {
                return new AuthModel();
            }
        ];
    }

    public function __construct()
    {
    }

    public function __clone(): void
    {
    }


}