<?php

namespace App\Controllers\roles;


use App\Contracts\Model;
use App\Controllers\BaseController;
use App\Models\roles\RoleModel;

class RoleController extends BaseController
{
    private Model $roleModel;
    private Model $checkRole;

    public function __construct(Model $roleModel, Model $checkRole)
    {
        $this->roleModel = $roleModel;
        $this->checkRole = $checkRole;
    }

    public function index()
    {
        $this->checkRole->requiredPermission();

        $roles = $this->roleModel->getAllRoles();

        $this->view('roles.index', compact('roles'));
    }

    public function create() {
        $this->checkRole->requiredPermission();

        $this->view('roles.create');
    }

    public function store() {
        $this->checkRole->requiredPermission();

        if (isset($_POST['role_name']) &&
            isset($_POST['role_description'])) {

            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];

            $this->roleModel->createRole($role_name, $role_description);
        }
        header('Location: /roles');
    }

    public function delete($param) {
        $this->checkRole->requiredPermission();

        $this->roleModel->deleteRole($param);
        header('Location: /roles');
    }

    public function edit($param) {

        $role = $this->roleModel->getRoleById($param);

        if (!$role) {
            echo "RoleModel not found!";
        }
        $this->view('roles.edit', compact('role'));

    }

    public function update() {


        if (isset($_POST['id']) &&
            isset($_POST['role_name']) &&
            isset($_POST['role_description'])
        ) {
            $id = trim($_POST['id']);
            $role_name = trim($_POST['role_name']);
            $role_description = trim($_POST['role_description']);

            if (empty($role_name)) {
                echo "RoleModel name is not required!";
                return;
            }

            $this->roleModel->updateRole($role_name, $role_description, $id);
        }


        header('Location: /roles');
    }
}