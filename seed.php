<?php

require_once './vendor/autoload.php';

use App\Infrastructure\Services\Database;

$values = [];
foreach (range(0, 500) as $i) {
    $values []= [
        //timestamp integer
        1202131213 + $i * 100,
        random_int(1, 10),
        'message: #' . $i
    ];
}

$valuesString = array_map(function(array $row) {
    $date = new DateTime();
    $date->setTimestamp($row[0]);
    $timestampValue = $date->format('Y-m-d H:i:s');

    return "('$timestampValue', $row[1], '$row[2]')";
}, $values);
$valuesString = implode(',', $valuesString);

$sql = <<<SQL
    insert into logs(ts, type, message)
    values $valuesString
SQL;

Database::makeWithDefaultConfig()->execute("truncate logs;");
Database::makeWithDefaultConfig()->execute($sql);
