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
        '/test' => [
            'file' => 'app/controllers/TestController.php',
            'class' => 'App\Controllers\TestController',
            'method' => 'index',
        ],

    ];

public static function findRoute($route) {

    //если был передан параметр то надо разобраться с ним, а если параметра нету, то сразу проверим путь...
    if (preg_match('/\/[A-Za-z]+\/[0-9]+/', $route, $array)) {

        $split = preg_split('/\//', $array[0]);
        $route = '/' . $split[1] . '/{id}';
        $param = $split[2];

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