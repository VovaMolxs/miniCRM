<?php

namespace App\Controllers\pages;

use App\Contracts\Model;
use App\Controllers\BaseController;

class PageController extends BaseController
{

    private Model $pageModel;
    private Model $roleModel;
    private Model $checkRole;


    public function __construct(Model $pageModel, Model $roleModel, Model $checkRole)
    {
        $this->pageModel = $pageModel;
        $this->roleModel = $roleModel;
        $this->checkRole = $checkRole;

    }


    public function index()
    {
        $this->checkRole->requiredPermission();
        $pages = $this->pageModel->getAllPages();

        $this->view('pages.index', compact('pages'));
    }

    public function create() {
        $this->checkRole->requiredPermission();

        $roles = $this->roleModel->getAllRoles();
        $this->view('pages.create', compact('roles'));
    }

     public function store() {
         $this->checkRole->requiredPermission();

            if (isset($_POST['page_title']) && isset($_POST['page_slug']) && isset($_POST['roles'])){
                $page_title = $_POST['page_title'];
                $page_slug = $_POST['page_slug'];

                $roles = implode(",", $_POST['roles']);

                if (empty($page_title || $page_slug || empty($roles))) {
                    echo "Tittle and Slug or Roles are required!";
                    return;
                }

                $this->pageModel->createPage($page_title, $page_slug, $roles);
            }
            header('Location: /pages');
    }

    public function delete($param) {
        $this->checkRole->requiredPermission();

        $this->pageModel->deletePage($param);
        header('Location: /pages');
    }



    public function edit($param) {

        $page = $this->pageModel->getPageById($param);
        $roles = $this->roleModel->getAllRoles();

        if (!$page) {
            echo "RoleModel not found!";
        }


        $this->view('pages.edit', compact('page', 'roles'));
    }

    public function update() {

        if (isset($_POST['id']) &&
            isset($_POST['page_title']) &&
            isset($_POST['page_slug']) &&
            isset($_POST['roles'])
        ) {
            $id = trim($_POST['id']);
            $page_title = trim($_POST['page_title']);
            $page_slug = trim($_POST['page_slug']);
            $roles = implode(',', $_POST['roles']);

            if (empty($page_title)) {
                echo "PageModel name is not required!";
                return;
            }

            $this->pageModel->updatePage($page_title, $page_slug, $roles, $id);
        }


        header('Location: /pages');
    }



}