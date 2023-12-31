<?php

namespace Core\di;

use App\Controllers\auth\AuthController;
use App\Controllers\IndexController;
use App\Controllers\pages\PageController;
use App\Controllers\roles\RoleController;
use App\Controllers\status\StatusController;
use App\Controllers\todo\category\CategoryController;
use App\Controllers\todo\tasks\TaskController;
use App\Controllers\users\UsersController;
use App\Models\auth\AuthModel;
use App\Models\Check;
use App\Models\pages\PageModel;
use App\Models\roles\RoleModel;
use App\Models\todo\category\CategoryModel;
use App\Models\todo\tasks\TaskModel;
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
                    $this->get(RoleModel::class),
                    $this->get(Check::class)
                );
            },
            RoleController::class => function () {
                return new RoleController(
                    $this->get(RoleModel::class),
                    $this->get(Check::class)
                );
            },
            AuthController::class => function () {
                return new AuthController(
                    $this->get(AuthModel::class)
                );
            },
            PageController::class => function () {
                return new PageController(
                    $this->get(PageModel::class),
                    $this->get(RoleModel::class),
                    $this->get(Check::class)
                );
            },
            Check::class => function() {
                return new Check(
                    $this->get(PageModel::class)
                );
            },
            CategoryController::class => function () {
                return new CategoryController(
                    $this->get(CategoryModel::class),
                    $this->get(Check::class)
                );
            },
            TaskController::class => function () {
                return new TaskController(
                    $this->get(TaskModel::class),
                    $this->get(Check::class),
                    $this->get(CategoryModel::class)
                );
            },
            StatusController::class => function () {
                return new StatusController();
            },
            UserModel::class => function () {
                return new UserModel();
            },
            RoleModel::class => function () {
                return new RoleModel();
            },
            AuthModel::class => function () {
                return new AuthModel();
            },
            PageModel::class => function () {
                return new PageModel();
            },
            CategoryModel::class => function () {
                return new CategoryModel();
            },
            TaskModel::class => function() {
                return new TaskModel();
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