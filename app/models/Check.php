<?php

namespace App\Models;

use App\Contracts\Model;

class Check implements Model
{
    private Model $pageModel;

    public function __construct(Model $pageModel)
    {
        $this->pageModel = $pageModel;
    }


    public function getCurrentUrlSlug() {
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $parseUrl = parse_url($url);
        $path = $parseUrl['path'];
        preg_match('/(?<=\/)([A-z0-9]+)/', $path, $slug);
        return $slug[0];
    }

    public function checkPermission($slug) {
        $page = $this->pageModel->findBySlug($slug);

        if (!$page) {
            return false;
        }

        $allowedRoles = explode(',', $page['role']);

        if($_SESSION['user_role'] == 5) {
            return true;
        }

        if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $allowedRoles)) {
            return true;
        } else {
            return false;
        }
    }

    public function requiredPermission() {
        $slug = $this->getCurrentUrlSlug();

        if (!$this->checkPermission($slug)) {
            header('Location: /');
            return;
        }
    }

    public function createTable()
    {
        // TODO: Implement createTable() method.
    }
}