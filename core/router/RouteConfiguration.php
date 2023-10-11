<?php

namespace Core\router;

class RouteConfiguration
{
    private string $route;
    private string $controller;


    private string $action;
    private string $name;
    private string $middleware;

    /**
     * @return string
     */
    public function getMiddleware(): string
    {
        return $this->middleware;
    }

    /**
     * @param string $route
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $route, string $controller, string $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function name(string $name): RouteConfiguration {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): RouteConfiguration {
        $this->middleware = $middleware;
        return $this;
    }
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }
    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}