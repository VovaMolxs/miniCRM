<?php

namespace App\Controllers\todo\category;


use App\Contracts\Model;
use App\Controllers\BaseController;

class CategoryController extends BaseController
{
    private Model $todoCategoryModel;
    private Model $checkRole;

    public function __construct(Model $todoCategoryModel, Model $checkRole)
    {
        $this->todoCategoryModel = $todoCategoryModel;
        $this->checkRole = $checkRole;
    }

    public function index()
    {
        $this->checkRole->requiredPermission();

        $category = $this->todoCategoryModel->getAllCategory();

        $this->view('todo.category.index', compact('category'));
    }

    public function create() {
        $this->checkRole->requiredPermission();

        $this->view('todo.category.create');
    }

    public function store() {
        $this->checkRole->requiredPermission();

        if (isset($_POST['title']) &&
            isset($_POST['description']) &&
            isset($_SESSION['user_id'])) {

            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_id = $_SESSION['user_id'];

            $this->todoCategoryModel->createCategory($title, $description, $user_id);
        }
        header('Location: /todo/category');
    }

    public function delete($param) {
        $this->checkRole->requiredPermission();

        $this->todoCategoryModel->deleteCategory($param);
        header('Location: /todo/category');
    }

    public function edit($param) {

        $todoCategory = $this->todoCategoryModel->getCategoryId($param);

        if (!$todoCategory) {
            echo "CategoryModel not found!";
        }
        $this->view('todo.category.edit', compact('todoCategory'));

    }

    public function update() {

        if (isset($_POST['id']) &&
            isset($_POST['title']) &&
            isset($_POST['description'])
        ) {

            $id = trim($_POST['id']);
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $usability = isset($_POST['usability']) ? 1 : 0;

            $this->todoCategoryModel->updateCategory($title, $description, $usability, $id);
        }


        header('Location: /todo/category');
    }
}