<?php
require __DIR__ . '/vendor/autoload.php';

use TesteApp\App\Router;
use TesteApp\App\View;
use TesteApp\Controllers\ImportingViewController;
use TesteApp\Controllers\LoginViewController;
use TesteApp\Controllers\PatientsViewController;
use TesteApp\Utils\AuthGuard;

$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__ . '/.env');

session_start();

// ROUTES SESSION
$router = new Router();

$router->on('GET', '/', static function () {
    AuthGuard::redirectIfNotLoggedIn();
    View::render('Index');
})->on('GET', '/login', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new LoginViewController())->index();
})->on('POST', '/login', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new LoginViewController())->login();
})->on('GET', '/cadastro', static function () {
    AuthGuard::redirectIfLoggedIn();
    View::render('Register/register');
})->on('POST', '/cadastro', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new LoginViewController())->register();
})->on('POST', '/logout', static function () {
    AuthGuard::redirectIfNotLoggedIn();
    (new LoginViewController())->logout();
})->on('GET', '/pacientes', static function () {
    AuthGuard::redirectIfNotLoggedIn();
    (new PatientsViewController())->index();
})->on('GET', '/importar', static function() {
    AuthGuard::redirectIfNotLoggedIn();
    (new ImportingViewController())->index();
})->on('POST', '/importar', static function() {
    AuthGuard::redirectIfNotLoggedIn();
    (new ImportingViewController())->import();
});



$router->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
