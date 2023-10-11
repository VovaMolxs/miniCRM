<?php

namespace Core;

use Core\Router\Router;
use Core\Template\TemplateClass;
use Core\DI\DIContainer;

class Core extends AbstractCore
{

    private static $instance = null;
    private $systemObject = [];

    //делаем класс одиночку
    public static function getInstance() {
        if (!self::$instance) {
            return self::$instance = new self();
        }
            return self::$instance;
    }
    //закрываем от доступа извне
    private function __construct() {

    }
    //закрываем от доступа извне
    private function __clone() {

    }
    //создаются системные обЪекты
    public function init()
    {
        if (empty($this->systemObject)) {
            //добавляем наши системные объекты для того чтобы не создавать их самим
            $this->systemObject['template'] = TemplateClass::getInstance();
            $this->systemObject['di'] = diContainer::getInstance();
            $this->systemObject['router'] = Router::getInstance();
        }

        //создаем каждый системный объект...
        foreach ($this->systemObject as $object) {
            $object->init();
        }
    }

    public function getSystemObject($param) {
        foreach ($this->systemObject as $key => $value) {
            if ($key == $param) {
                return $value;
            }
        }
        die('not find system Object!!!');
    }
}