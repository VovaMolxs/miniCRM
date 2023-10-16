<?php

use App\Controllers\auth\AuthController;
use App\Controllers\IndexController;
use App\Controllers\roles\RoleController;
use App\Controllers\status\StatusController;
use App\Controllers\todo\category\CategoryController;
use App\Controllers\todo\tasks\TaskController;
use App\Controllers\users\UsersController;
use Core\Router\Router;

Router::get('/', [IndexController::class, 'index']);
Router::get('/todo/category', [CategoryController::class, 'index']);
Router::get('/todo/category/create', [CategoryController::class, 'create']);
Router::post('/todo/category/store', [CategoryController::class, 'store']);
Router::get('/todo/category/edit/{param}', [CategoryController::class, 'edit']);
Router::post('/todo/category/update/{param}', [CategoryController::class, 'update']);
Router::get('/todo/category/delete/{param}', [CategoryController::class, 'delete']);

Router::get('/todo/tasks', [TaskController::class, 'index']);
Router::get('/todo/tasks/create', [TaskController::class, 'create']);
Router::post('/todo/tasks/store', [TaskController::class, 'store']);

Router::get('/register', [AuthController::class, 'register']);
Router::post('/register/store', [AuthController::class, 'store']);

Router::get('/login', [AuthController::class, 'login']);
Router::post('/login/authenticate', [AuthController::class, 'authenticate']);

Router::get('/logout', [AuthController::class, 'logout']);

Router::get('/roles', [RoleController::class, 'index']);
Router::get('/roles/edit/{param}', [RoleController::class, 'edit']);
Router::post('/roles/update', [RoleController::class, 'update']);
Router::get('/roles/create', [RoleController::class, 'create']);
Router::post('/roles/store', [RoleController::class, 'store']);

Router::get('/users', [UsersController::class, 'index'])->middleware('admin');
Router::get('/users/create', [UsersController::class, 'create']);
Router::post('/users/store', [UsersController::class, 'store']);
Router::post('/users/update', [UsersController::class, 'update']);
Router::get('/users/delete/{param}', [UsersController::class, 'delete']);
Router::get('/users/edit/{param}', [UsersController::class, 'edit']);

Router::get('/pages', [\App\Controllers\pages\PageController::class, 'index']);
Router::get('/pages/create', [\App\Controllers\pages\PageController::class, 'create']);
Router::post('/pages/store', [\App\Controllers\pages\PageController::class, 'store']);
Router::get('/pages/delete/{param}', [\App\Controllers\pages\PageController::class, 'delete']);
Router::get('/pages/edit/{param}', [\App\Controllers\pages\PageController::class, 'edit']);
Router::post('pages/update', [\App\Controllers\pages\PageController::class, 'update']);

Router::get('/404', [StatusController::class, 'index']);
