<?php

namespace App\Controllers\roles;


use App\Controllers\Controller;
use App\Models\roles\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        $this->view('roles.index', compact('roles'));
    }

    public function create() {
        $this->view('roles.create');
    }

    public function store() {
        if (isset($_POST['role_name']) &&
            isset($_POST['role_description'])) {

            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];

            $role = new Role();
            $role->createRole($role_name, $role_description);
        }
        header('Location: /roles');
    }

    public function delete($param) {
        $role = new Role();

        $role->deleteRole($param);
        header('Location: /roles');
    }

    public function edit($param) {
        $role = new Role();
        $role = $role->getRoleById($param);
        if (!$role) {
            echo "Role not found!";
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
                echo "Role name is not required!";
                return;
            }

            $role = new Role();
            $role->updateRole($role_name, $role_description, $id);
        }


        header('Location: /roles');
    }
}