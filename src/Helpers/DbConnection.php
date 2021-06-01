<?php

namespace App\Helpers;


class DbConnection
{
    private $connection = null;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        try {
            $this->connection = new \PDO(
                "mysql:host=$host;port=$port;dbname=$db",
                $user,
                $pass
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function connet()
    {
        return $this->connection;
    }
}