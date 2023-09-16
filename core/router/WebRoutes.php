<?php

namespace Core\Router;

class WebRoutes
{
    private static $routes = [
        '/' => [
            'file' => 'app/controllers/IndexController.php',
            'class' => 'App\Controllers\IndexController',
            'method' => 'index',
        ],
        '/register' => [
            'file' => 'app/controllers/auth/AuthController.php',
            'class' => 'App\Controllers\auth\AuthController',
            'method' => 'register',
        ],
        '/register/store' => [
            'file' => 'app/controllers/auth/AuthController.php',
            'class' => 'App\Controllers\auth\AuthController',
            'method' => 'store',
        ],
        '/login' => [
            'file' => 'app/controllers/auth/AuthController.php',
            'class' => 'App\Controllers\auth\AuthController',
            'method' => 'login',
        ],
        '/login/authenticate' => [
            'file' => 'app/controllers/auth/AuthController.php',
            'class' => 'App\Controllers\auth\AuthController',
            'method' => 'authenticate',
        ],
        '/logout' => [
            'file' => 'app/controllers/auth/AuthController.php',
            'class' => 'App\Controllers\auth\AuthController',
            'method' => 'logout',
        ],
        '/roles' => [
            'file' => 'app/controllers/roles/RoleController.php',
            'class' => 'App\Controllers\roles\RoleController',
            'method' => 'index',
        ],
        '/roles/edit/{id}' => [
            'file' => 'app/controllers/roles/RoleController.php',
            'class' => 'App\Controllers\roles\RoleController',
            'method' => 'edit',
        ],
        '/roles/update' => [
            'file' => 'app/controllers/roles/RoleController.php',
            'class' => 'App\Controllers\roles\RoleController',
            'method' => 'update',
        ],
        '/roles/create' => [
            'file' => 'app/controllers/roles/RoleController.php',
            'class' => 'App\Controllers\roles\RoleController',
            'method' => 'create',
        ],
        '/roles/store' => [
            'file' => 'app/controllers/roles/RoleController.php',
            'class' => 'App\Controllers\roles\RoleController',
            'method' => 'store',
        ],
        '/users' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'index',
        ],
        '/users/create' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'create',
        ],
        '/users/store' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'store',
        ],
        '/users/update' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'update',
        ],
        '/users/delete/{id}' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'delete',
        ],
        '/users/edit/{id}' => [
            'file' => 'app/controllers/users/UsersController.php',
            'class' => 'App\Controllers\users\UsersController',
            'method' => 'edit',
        ],

    ];

public static function findRoute($route) {

    //если был передан параметр то надо разобраться с ним, а если параметра нету, то сразу проверим путь...
    if (preg_match('/\/[0-9]+/', $route)) {
        //проверили параметр в конце строки и дальше разбиваем нашу строку чере /
        $split = preg_split('/\//', $route);

        //получаем параметр, а затем собираем строку назад
        $param = end($split);
        $split[array_key_last($split)] = "{id}";
        $route = implode("/", $split);

        foreach (self::$routes as $key=>$value) {

            if ($key == $route) {
                $value['param'] = $param;
                return $value;
            }
        }

    } else {
        foreach (self::$routes as $key=>$value) {
            if ($key == $route) {
                return $value;
            }
        }

        die('page not found 404');
    }
}

}