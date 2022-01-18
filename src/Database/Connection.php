<?php
namespace PacientesSys\Database;

use PDO;


class Connection {
    /**
     * @var PDO
     */
    private static PDO $instance ;

    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            //new PDO from .env
            self::$instance = new PDO(
                $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ';'
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

}