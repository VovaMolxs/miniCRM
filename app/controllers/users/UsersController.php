<?php

namespace App\Controllers\users;

use App\Contracts\Controller;
use App\Contracts\Model;
use App\Controllers\BaseController;
use App\Models\roles\RoleModel;
use App\Models\users\UserModel;

class UsersController extends BaseController
{
    private Model $userModel;
    private Model $userRole;
    private Model $checkRole;

    public function __construct(Model $userModel, Model $roleModel, Model $checkRole)
    {
        $this->userModel = $userModel;
        $this->userRole = $roleModel;
        $this->checkRole = $checkRole;
    }


    public function index()
    {
        $users = $this->userModel->getAll();
        $this->checkRole->requiredPermission();

        $this->view('users.users', compact('users'));
    }

    public function create() {
        $this->checkRole->requiredPermission();
        $this->view('users.create');
    }

    public function store() {
        $this->checkRole->requiredPermission();
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


            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => 1,
            ];
            $this->userModel->create($data);
        }
        header('Location: /users');
    }

    public function delete($param) {
        $this->checkRole->requiredPermission();

        $this->userModel->delete($param);
        header('Location: /users');
    }

    public function edit($param) {
        $this->checkRole->requiredPermission();

        $user = $this->userModel->read($param);
        if (!$user) {
            die('Пользователь не найден!');
        }
        $user = $this->userModel->read($param);
        $role = $this->userRole->getAllRoles();

        $this->view('users.edit', compact('user', 'role'));

    }

    public function update() {
        $this->checkRole->requiredPermission();

        $this->userModel->update($_POST);

        header('Location: /users');
    }
}