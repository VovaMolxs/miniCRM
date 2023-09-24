<?php

namespace App\Controllers;

use App\Contracts\Controller;
use Core\Core;

class BaseController implements Controller
{

    public function view($template = 'index', array $params = []) {
        $core = Core::getInstance();

        $templater = $core->getSystemObject('template');
        $blade = $templater->getBlade();
        echo $blade->run($template, $params);
    }

    public function index()
    {
        // TODO: Implement index() method.
    }
}