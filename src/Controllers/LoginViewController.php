<?php

namespace PacientesSys\Controllers;

use PacientesSys\App\View;
use PacientesSys\Models\User;

class LoginViewController extends \PacientesSys\App\Controller
{
    // GET /login
    public function index() : void
    {
        View::render('/Login/index', ['errors' => $_SESSION['errors']['login'] ?? null]);

        parent::index();
    }

    // POST /login
    public function login() : void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = (new User())->where('email', $email)[0];

        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = $user;
                $_SESSION['isLogged'] = true;
                header('Location: /');
                return;
            }
            $errors[] = "Senha incorreta";
        } else {
            $errors[] = "Usuário não encontrado";
        }

        $_SESSION['errors']['login'] = $errors;
        header('Location: /login');
    }

    // POST /logout
    public function logout() : void
    {
        session_destroy();
        header('Location: /login');
    }
}