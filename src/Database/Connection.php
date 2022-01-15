<?php
namespace TesteApp\Database;

use PDO;

/**
 *
 */
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
                $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ";port=" .$_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

}