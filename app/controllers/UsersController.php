<?php

namespace App\Controllers;

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
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['admin'])) {
            $password = isset($_POST['password']);
            $confirm_password = isset($_POST['confirm_password']);

            if ($password !== $confirm_password) {
                echo "Password do not match!";
                return;
            }

            $userModel = new User();
            $userModel->create($_POST);
            header('Location: /users');
        }
    }

    public function delete($param) {
        $userModel = new User();

        $userModel->delete($param);
        header('Location: /users');
    }

    public function edit($param) {
        $userModel = new User();
        $user = $userModel->read($param);

        $this->view('users.edit', compact('user'));

    }

    public function update() {
        $userModel = new User();
        $userModel->update($_POST);

        header('Location: /users');
    }
}