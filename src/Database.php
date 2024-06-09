<?php

namespace Core;

use Dotenv\Dotenv;
use Exceptions\DatabaseConnectionException;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Database
{
    public function connect(): \mysqli
    {
        $mysqli = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

        if ($mysqli->connect_error) {
            throw new DatabaseConnectionException('Connection failed: ' . $mysqli->connect_error);
        }

        return $mysqli;
    }
}
