<?php

use App\Controllers\auth\AuthController;
use App\Controllers\IndexController;
use App\Controllers\roles\RoleController;
use App\Controllers\status\StatusController;
use App\Controllers\users\UsersController;
use Core\Router\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get('/register', [AuthController::class, 'register']);
Route::get('/register/store', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login']);
Route::get('/login/authenticate', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/edit/{param}', [RoleController::class, 'edit']);
Route::get('/roles/update', [RoleController::class, 'update']);
Route::get('/roles/create', [RoleController::class, 'create']);
Route::get('/roles/store', [RoleController::class, 'store']);

Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/create', [UsersController::class, 'create']);
Route::get('/users/store', [UsersController::class, 'store']);
Route::get('/users/update', [UsersController::class, 'update']);
Route::get('/users/delete/{param}', [UsersController::class, 'delete']);
Route::get('/users/edit/{param}', [UsersController::class, 'edit']);

Route::get('/404', [StatusController::class, 'index']);
