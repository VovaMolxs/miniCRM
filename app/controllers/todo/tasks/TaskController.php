<?php

namespace App\Controllers\todo\tasks;

use App\Contracts\Model;
use App\Controllers\BaseController;

class TaskController extends BaseController
{
    private Model $taskModel;
    private Model $checkRole;
    private Model $categoryModel;


    public function __construct(Model $taskModel, Model $checkRole, Model $categoryModel)
    {

        $this->taskModel = $taskModel;
        $this->checkRole = $checkRole;
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $this->checkRole->requiredPermission();

        $tasks = $this->taskModel->getAllTasks();

        $this->view('todo.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $this->checkRole->requiredPermission();

        $categories = $this->categoryModel->getAllCategoryWithUsability();

        $this->view('todo.tasks.create', compact('categories'));

    }

    public function store() {
        //$this->checkRole->requiredPermission();

        if (isset($_POST['title']) &&
            isset($_POST['category_id']) &&
            isset($_POST['finish_date'])
        ) {
            $data['title'] = $_POST['title'];
            $data['category_id'] = $_POST['category_id'];
            $data['finish_at'] = $_POST['finish_date'];
            $data['user_id'] = $_SESSION['user_id'];
            $data['status'] = 'new';
            $data['priority'] = 'low';

            $this->taskModel->createTask($data);

        }
        header('Location: /todo/tasks');
    }

    public function delete($param) {
        $this->checkRole->requiredPermission();

    }

    public function edit($param) {
        $this->checkRole->requiredPermission();

    }

    public function update() {
        $this->checkRole->requiredPermission();

    }

}