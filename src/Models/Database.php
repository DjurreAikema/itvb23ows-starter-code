<?php

namespace Models;

use mysqli;
use Dotenv\Dotenv;
use Exceptions\DatabaseConnectionException;

class Database
{
    private static ?Database $instance = null;
    private mysqli $connection;

    /**
     * @throws DatabaseConnectionException
     */
    private function __construct()
    {
        // Load environment variables from .env file
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        // Setting up the database connection using environment variables
        $this->connection = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);

        if ($this->connection->connect_error) {
            throw new DatabaseConnectionException('Connection failed: ' . $this->connection->connect_error);
        }
    }

    // Singleton pattern to ensure only one instance of the Database class is created
    public static function getInstance(): Database
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Getter method to return the mysqli connection object, used for database operations
    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}
