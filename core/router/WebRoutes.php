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
        '/users' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
            'method' => 'index',
        ],
        '/users/create' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
            'method' => 'create',
        ],
        '/users/store' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
            'method' => 'store',
        ],
        '/users/update' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
            'method' => 'update',
        ],
        '/users/delete/{id}' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
            'method' => 'delete',
        ],
        '/users/edit/{id}' => [
            'file' => 'app/controllers/UsersController.php',
            'class' => 'App\Controllers\UsersController',
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