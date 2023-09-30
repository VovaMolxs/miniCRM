<?php

namespace App\Controllers\status;

use App\Controllers\BaseController;

class StatusController extends BaseController
{
 public function index()
 {
     $this->view('status.404');
 }
}