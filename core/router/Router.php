<?php
namespace Core\Router;

use Core\AbstractCore;

class Router extends AbstractCore
{

    private static $instance = null;
    private $path = [];

    private function __clone() {

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
        var_dump($this->path);
    }
}