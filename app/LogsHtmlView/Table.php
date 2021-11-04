<?php

declare(strict_types=1);

namespace App\LogsHtmlView;

use App\ToHtml;

class Table implements ToHtml
{
    private array $logs;

    public function __construct(array $logs)
    {
        $this->logs = $logs;
    }

    public function makeHtml(): string
    {
        $rowsHtml = array_map(function (array $row) {
            $timestamp = (new \DateTime($row['ts']))->getTimestamp();

            return <<<HTML
<tr>
  <td>${timestamp}</td>
  <td>${row['ts']}</td>
  <td>${row['type']}</td>
  <td>${row['message']}</td>
</tr>
HTML;
        }, $this->logs);
        $rowsHtml = implode('', $rowsHtml);

        return <<<HTML
<h2>
Таблица: 
</h2>
Сортировка по дате:
<button onclick="sortTable('asc')" ><strong> По возрастанию </button>
<button onclick="sortTable('desc')" ><strong> По убыванию </button>
<table>
  <tr>
    <td><strong>TS(timestamp)</td>
    <td><strong>TS(date)</td>
    <td><strong>Type</td>
    <td><strong>Message</td>
  </tr>
  $rowsHtml
</table>
HTML;
    }
}