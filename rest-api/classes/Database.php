<?php

class Database
{
    protected $conn;

    public function __construct(private string $host, private string $name, private string $user, private string $password)
    {
    }

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host}; dbname={$this->name}; charset=utf8";

        $conn = new PDO(
            $dsn,
            $this->user,
            $this->password,
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            ]
        );
        try {
            return $conn;
        } catch (PDOException $e) {
            echo "Could not connect to the database $this->name :" . $e->getMessage();
            die();
        }
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}
