<?php
require __DIR__ . '/vendor/autoload.php';

use PacientesSys\App\Router;
use PacientesSys\Controllers\ImportingViewController;
use PacientesSys\Controllers\LoginViewController;
use PacientesSys\Controllers\PatientsViewController;
use PacientesSys\Controllers\RegisterViewController;
use PacientesSys\Utils\AuthGuard;

$db = parse_url(getenv("DATABASE_URL"));

$_ENV['DB_DRIVER'] = 'sqlite';
$_ENV['DB_HOST'] = $db['app.sqlite'];

session_start();

// Seção de rotas
$router = new Router();

$router->on('GET', '/', static function () {
    header('Location: /pacientes');
})->on('GET', '/login', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new LoginViewController())->index();
})->on('POST', '/login', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new LoginViewController())->login();
})->on('GET', '/cadastro', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new RegisterViewController())->index();
})->on('POST', '/cadastro', static function () {
    AuthGuard::redirectIfLoggedIn();
    (new RegisterViewController())->register();
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
})->on('POST', '/pacientes/patch', static function() {
    AuthGuard::redirectIfNotLoggedIn();
    (new PatientsViewController())->patch();
})->on('POST', '/pacientes/delete', static function () {
    AuthGuard::redirectIfNotLoggedIn();
    (new PatientsViewController())->delete();
})->on('POST', '/pacientes/put', function () {
    AuthGuard::redirectIfNotLoggedIn();
    (new PatientsViewController())->put();
})->on('GET', '/migrate', function () {

    try {
        $database = new SQLite3('app.sqlite');

        // run query from sql file
        $sql = file_get_contents('docker/db/create_db.sql');
        $database->exec($sql);
        $database->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }

});

$router->default = '/';

$router->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
