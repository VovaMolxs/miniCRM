<?php
namespace Core\Template;

use Core\AbstractCore;
use eftec\bladeone\BladeOne;

class TemplateClass extends AbstractCore
{
    private static $instance = null;
    private $blade;

    private function __construct() {

    }

    private function __clone(): void
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            return self::$instance = new self;
        }
        return self::$instance;
    }

    public function init()
    {
        $views = $_SERVER['DOCUMENT_ROOT'] . '/app/views';
        $cache = $_SERVER['DOCUMENT_ROOT'] . '/core/template/cache';
        $this->blade = new BladeOne($views,$cache,BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.

    }

    public function getBlade() {
        return $this->blade;
    }

}