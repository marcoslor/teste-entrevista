<?php
namespace TesteApp\Utils;

class AuthGuard {
    public static function redirectIfNotLoggedIn() {
        if (!isset($_SESSION['isLogged'])) {
            header('Location: /login');
            exit;
        }
    }
    public static function redirectIfLoggedIn() {
        if (isset($_SESSION['isLogged'])) {
            header('Location: /');
            exit;
        }
    }
}