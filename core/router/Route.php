<?php
namespace Core\Router;

class Route
{
    private static $instance = null;
    private static array $routerGet = [];

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

        foreach (self::getRouterGet() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }
    }

     public static function get(string $route, array $controller): RouteConfiguration
     {
         $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
         self::$routerGet[] = $routeConfiguration;
         return $routeConfiguration;
    }

    /**
     * @return array
     */
    public static function getRouterGet(): array
    {
        return self::$routerGet;
    }
}