<?php
require __DIR__. '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use TesteApp\App\Router;
use TesteApp\App\View;
use TesteApp\Controllers\LoginController;
use TesteApp\Utils\AuthGuard;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

session_start();


// ROUTES SESSION
$router = new Router();

$router->on('GET', '/', static function () {
        AuthGuard::redirectIfNotLoggedIn();
        View::render('Index');
    })->on('GET', '/login', static function () {
        AuthGuard::redirectIfLoggedIn();
        (new LoginController())->index();
    })->on('POST', '/login', static function () {
        AuthGuard::redirectIfLoggedIn();
        (new LoginController())->login();
    })->on('GET','/register', static function () {
        AuthGuard::redirectIfLoggedIn();
        View::render('Register/register');
    })->on('POST','/register', static function () {
        AuthGuard::redirectIfLoggedIn();
        (new LoginController())->register();
    })->on('GET','/test', static function () {
        try{
            $user = new \TesteApp\Models\User([
                'name' => 'Teste',
                'email' => 'test',
                'password' => 'test'
            ]);
            echo "user email: ".$user->email;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    });

$router->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
