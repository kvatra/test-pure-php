<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Infrastructure\DTO\LogFilter;
use PDO;
use PDOStatement;

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

    public function execute(string $sql)
    {
        return $this->makePreparedPdo($sql)
            ->execute();
    }

    public function fetch(string $sql, array $bindings = []): array
    {
        $dto = $this->makePreparedPdo($sql);
        $dto->execute($bindings);

        return $dto->fetchAll(PDO::FETCH_ASSOC);
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

    private function makePreparedPdo(string $sql): PDOStatement
    {
        $connectionString = "pgsql:dbname=$this->database;host=$this->host";

        $pdo = new PDO($connectionString, $this->user, $this->password, [
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        ]);

        return $pdo->prepare($sql);
    }
}