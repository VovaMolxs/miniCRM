<?php

namespace App\Controllers;

use Core\Core;

class Controller
{
    public function index() {}

    public function view($template = 'index', array $params = []) {
        $core = Core::getInstance();

        $templater = $core->getSystemObject('template');
        $blade = $templater->getBlade();
        echo $blade->run($template, $params);
    }
}