<?php
namespace App\Controllers;

class IndexController extends Controller
{
    public function index() {
        $this->display('hello', ["variable1"=>"value54645"]);
    }
}