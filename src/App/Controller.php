<?php

namespace PacientesSys\App;

abstract class Controller
{
    public function __construct() {

    }

    public function index() {
        unset($_SESSION['errors'], $_SESSION['success']);
    }
}