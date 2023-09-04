<?php
namespace App\Controllers;

class IndexController extends Controller
{
    public function index() {
        $this->view('hello', ["variable1"=>"value54645"]);
    }
}