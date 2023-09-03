<?php

namespace Core;

class Core extends AbstractCore
{

    private static $instance = null;

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

    public function init()
    {

    }
}