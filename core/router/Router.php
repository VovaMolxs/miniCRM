<?php
namespace Core\Router;

class Router
{
    private static $instance = null;
    private static array $routerGet = [];
    private static array $routerPost = [];

    public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    private function __construct() {
        $this->init();
    }

    public static function getInstance() {
        if (!self::$instance) {
            return self::$instance = new self();
        }
        return self::$instance;
    }

    public function init()
    {
        $this->path = explode( '/', $_SERVER['REQUEST_URI']);
    }

    public function run() {
        $requestMethod =  ucfirst(strtolower($_SERVER['REQUEST_METHOD']));

        $methodName = 'getRouter' . $requestMethod;

        foreach (self::$methodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->prepareRoute();
        }

        die('Page not found!');
    }

     public static function get(string $route, array $controller): RouteConfiguration
     {
         $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
         self::$routerGet[] = $routeConfiguration;
         return $routeConfiguration;
    }

    public static function post(string $route, array $controller): RouteConfiguration
     {
         $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
         self::$routerPost[] = $routeConfiguration;
         return $routeConfiguration;
    }

    /**
     * @return array
     */
    public static function getRouterGet(): array
    {
        return self::$routerGet;
    }

    /**
     * @return array
     */
    public static function getRouterPost(): array
    {
        return self::$routerPost;
    }
}