<?php

declare(strict_types=1);

namespace App;

use PDO;

class Database
{
    private string $host;
    private string $database;
    private string $user;
    private string $password;

    public function __construct(string $host, string $database, string $user, string $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
    }

    public function execute(string $sql, array $options = [])
    {
        $pdo = $this->makePdo();

        return $pdo->prepare($sql, $options)
            ->execute($options);
    }

    public static function makeWithDefaultConfig(): self
    {
        return new self(
            'pgsql',
            'nevosoft',
            'user',
            'qwerty123'
        );
    }

    private function makePdo(): PDO
    {
        $connectionString = "pgsql:dbname=$this->database;host=$this->host";

        return new PDO($connectionString, $this->user, $this->password, [
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        ]);
    }
}