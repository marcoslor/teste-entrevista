<?php
namespace TesteApp\Config;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public static function setEnv()
    {
        //loads .env file
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env');
    }

    public static function start()
    {
        session_start();
        self::setEnv();
    }
}