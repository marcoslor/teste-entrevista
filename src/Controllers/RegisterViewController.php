<?php

namespace PacientesSys\Controllers;

use PacientesSys\App\Controller;
use PacientesSys\App\View;
use PacientesSys\Models\User;

class RegisterViewController extends Controller
{

    public function index() : void
    {
        View::render('Register/register', [$_SESSION['errors']['register'] ?? null]);

        parent::index();
    }

    public function register() : void
    {
        //ver se user já existe
        if (!empty((new User())->where('email', $_POST['email']))) {
            $errors['default'][] = "Usuário já existe";

            $_SESSION['errors']['register'] = $errors;
            header('Location: /cadastro');

            return;
        }

        //ver se senhas são válidas
        if ($_POST['password'] !== $_POST['password_confirmation']) {
            $errors['default'][] = "As senhas não são iguais";

            $_SESSION['errors']['register'] = $errors;
            header('Location: /cadastro');

            return;
        }

        //inserir user
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->create();

        //redirecionar para o login
        header('Location: /login');
    }
}