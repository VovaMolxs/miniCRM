<?php

namespace App\Controllers\auth;

use App\Contracts\Model;
use App\Controllers\BaseController;
use App\Models\auth\AuthModel;
use App\Models\roles\RoleModel;
use App\Models\users\UserModel;
use function App\Controllers\setcookie;

class AuthController extends BaseController
{

    private Model $authModel;

    public function __construct(Model $authModel)
    {
        $this->authModel = $authModel;
    }


    public function register() {
        $this->view('auth.register');
    }

    public function login() {
        $this->view('auth.login');
    }

    public function authenticate() {


        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

            $user = $this->authModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];

                if ($remember == 'on') {
                    setcookie('user_email', $email, time() + (7*24*60*60), '/');
                    setcookie('password', $password, time() + (7*24*60*60), '/');
                }
                header('Location: /');
            } else {
                echo "Invalid email or password!";
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
       header("location: /");
    }

    public function store() {
        if (isset($_POST['username']) &&
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['confirm_password'])) {

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if (empty($username) ||
                empty($email) ||
                empty($password) ||
                empty($confirm_password)) {
                echo "All fields are required!";
            }

            if ($password !== $confirm_password) {
                echo "Password do not match!";
                return;
            }


            $this->authModel->register($username, $email, $password);
        }
        header('Location: /login');
    }
}