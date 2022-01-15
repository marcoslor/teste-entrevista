<?php
require dirname(__DIR__) . '/vendor/autoload.php';

TesteApp\Config\Config::start();
TesteApp\Utils\AuthGuard::redirectIfNotLoggedIn();

session_start();
session_destroy();
header("Location: index.php");