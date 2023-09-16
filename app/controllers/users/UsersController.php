<?php

namespace App\Controllers\users;

use App\Controllers\Controller;
use App\Models\roles\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->getAll();

        $this->view('users.users', compact('users'));
    }

    public function create() {
        $this->view('users.create');
    }

    public function store() {
        if (isset($_POST['username']) &&
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['confirm_password'])) {

            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                echo "Password do not match!";
                return;
            }

            $userModel = new User();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => 1,
            ];
            $userModel->create($data);
        }
        header('Location: /users');
    }

    public function delete($param) {
        $userModel = new User();

        $userModel->delete($param);
        header('Location: /users');
    }

    public function edit($param) {
        $userModel = new User();
        $user = $userModel->read($param);

        $userRole = new Role();
        $role = $userRole->getAllRoles();

        $this->view('users.edit', compact('user', 'role'));

    }

    public function update() {
        $userModel = new User();
        $userModel->update($_POST);

        header('Location: /users');
    }
}