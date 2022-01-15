<?php

namespace TesteApp\Utils;

class AuthGuard
{

    public static function redirectIfNotLoggedIn(): void
    {
        if (!isset($_SESSION['isLogged'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function redirectIfLoggedIn(): void
    {
        if (isset($_SESSION['isLogged'])) {
            header('Location: /');
            exit;
        }
    }
}