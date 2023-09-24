<?php
namespace Core\Router;

use Core\AbstractCore;
use Core\Core;

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
    }

    public function findPatch() {
        //если найдем роута, то подтянем данные роута
        $fileInfo = WebRoutes::findRoute($_SERVER['REQUEST_URI']);
        //проверяем существует ли файл, если да то подключаем его...
        $this->checkFile($fileInfo);
        $object = $this->checkClass($fileInfo);
        if (!empty($fileInfo['param'])) {
            $this->checkMethod($object, $fileInfo['method'], $fileInfo['param']);
        } else $this->checkMethod($object, $fileInfo['method']);
    }

    public function checkFile($param) {

        if (!file_exists($param['file'])) {
            die('There is not such file!');
        }
        require_once $param['file'];
    }

    public function checkClass($param) {
        $container = Core::getInstance()->getSystemObject('di');

        if (!class_exists($param['class'])) {
            echo $param['class'];
            //throw new \Exception($param['class']." does not exist");
        }
        return $container->get($param['class']);

    }

    public function checkMethod($object, $method, $params  = null, $redirect = null) {
        if (!method_exists($object, $method)) {
            die("with method: $method");
        }

        $object->$method($params, $redirect);
    }
}