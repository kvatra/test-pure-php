<?php

require_once './vendor/autoload.php';

use App\Infrastructure\Services\Database;

$sql = <<<SQL
    create table logs (
        ts timestamp,
        type smallint,
        message varchar
    )
SQL;

Database::makeWithDefaultConfig()->execute($sql);
