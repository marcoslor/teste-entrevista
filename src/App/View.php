<?php

namespace TesteApp\App;

class View
{
    public static function render(string $view, array $data = [])
    {
        extract($data, EXTR_OVERWRITE);
        require __DIR__ . "/../Views/{$view}.php";
    }

}