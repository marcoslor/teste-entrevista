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

            if ($_ENV['DB_DRIVER'] === 'sqlite') {
                $pdo =  new PDO($_ENV['DB_DRIVER'] . ':' . $_ENV['DB_HOST']);
            }
            else {
                $pdo =  new PDO($_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
            }

            //new PDO from .env
            self::$instance = $pdo;

            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // run migrations
            Migrations::run();

        }
        return self::$instance;
    }

}