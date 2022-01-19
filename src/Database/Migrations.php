<?php

namespace PacientesSys\Database;

class Migrations
{
    // executa a query sql para criar as tabelas
    public static function run(): void
    {
        $sql = file_get_contents(__DIR__ . '/../../create_db.sql');

        Connection::getInstance()->exec($sql);
    }
}