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
                'password' => password_hash($password, PASSWORD_DEFAULT),
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

        $this->view('users.edit', compact('user'));

    }

    public function update() {
        $userModel = new User();
        $userModel->update($_POST);

        header('Location: /users');
    }
}