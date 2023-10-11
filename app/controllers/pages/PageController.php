<?php

namespace App\Controllers\pages;

use App\Contracts\Model;
use App\Controllers\BaseController;

class PageController extends BaseController
{

    private Model $pageModel;

    public function __construct(Model $pageModel)
    {
        $this->pageModel = $pageModel;
    }


    public function index()
    {
        $pages = $this->pageModel->getAllPages();
        $this->view('pages.index', compact('pages'));
    }

    public function create() {
        $this->view('pages.create');
    }

     public function store() {
            if (isset($_POST['page_title']) &&
                isset($_POST['page_slug'])) {

                $page_title = $_POST['page_title'];
                $page_slug = $_POST['page_slug'];

                $this->pageModel->createPage($page_title, $page_slug);
            }
            header('Location: /pages');
    }

    public function delete($param) {

        $this->pageModel->deletePage($param);
        header('Location: /pages');
    }

    public function edit($param) {
        $page = $this->pageModel->getPageById($param);

        if (!$page) {
            echo "RoleModel not found!";
        }
        $this->view('pages.edit', compact('page'));
    }

    public function update() {

        if (isset($_POST['id']) &&
            isset($_POST['page_title']) &&
            isset($_POST['page_slug'])
        ) {
            $id = trim($_POST['id']);
            $page_title = trim($_POST['page_title']);
            $page_slug = trim($_POST['page_slug']);

            if (empty($page_title)) {
                echo "PageModel name is not required!";
                return;
            }

            $this->pageModel->updatePage($page_title, $page_slug, $id);
        }


        header('Location: /pages');
    }



}