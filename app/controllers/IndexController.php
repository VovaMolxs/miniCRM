<?php
namespace App\Controllers;

use App\Contracts\Controller;

class IndexController extends BaseController
{
    public function index() {
        $this->view('index');
    }
}