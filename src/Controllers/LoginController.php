<?php

namespace TesteApp\Controllers;

use TesteApp\App\View;
use TesteApp\Database\Connection;
use TesteApp\Models\User;
use TesteApp\Utils\AuthGuard;

class LoginController extends \TesteApp\App\Controller
{
    // GET /login
    public function index()
    {
        View::render('Login/login');
    }

    // POST /login
    public function login()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = (new User())->where('email', $email)[0];

        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = $user;
                $_SESSION['isLogged'] = true;
                echo 'Logado com sucesso!';
            } else {
                echo 'Senha incorreta';
            }
        } else {
            echo 'Usuário não encontrado';
        }
    }

    // POST /register
    public function register()
    {
        //ver se user já existe
        if(!empty((new User())->where('email', $_POST['email']))) {
            $errors['general'][] = "Usuário já existe";

            View::render('Register/register', [
                'errors' => $errors
            ]);

            return false;
        }

        //ver se senhas são válidas
        if($_POST['password'] !== $_POST['password_confirmation']) {
            $errors['general'][] = "As senhas não são iguais";

            View::render('Register/register', [
                'errors' => $errors
            ]);

            return false;
        }

        //inserir user
        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->save();

        //redirecionar para o login
        header('Location: /login');
        return true;
    }

    // POST /logout
    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}