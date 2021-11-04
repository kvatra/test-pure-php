<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Infrastructure\DTO\LogFilter;
use App\Infrastructure\DTO\LogPage;
use App\Infrastructure\DTO\LogRequest;

class LogRetriever
{
    private const PAGE_LIMIT = 100;

    public function fetch(LogRequest $request): LogPage
    {
        $conditionString = $this->makeConditionString($request);
        $bindings = array_map(fn (LogFilter $filter) => $filter->getValue(), $request->getFilters());
        $requestPage = $request->getPage();

        $pageData = $this->fetchPageData($conditionString, $bindings, $requestPage, $request->getSort());

        $count = $this->fetchCount($conditionString, $bindings);
        $lastPage = ceil($count / self::PAGE_LIMIT) - 1;
        $prevPageExists = $requestPage > 0;
        $nextPageExists = $requestPage < $lastPage;

        return new LogPage($pageData, $requestPage, $prevPageExists, $nextPageExists);
    }

    private function fetchCount(?string $conditionString, array $bindings): int
    {
        $sql = "SELECT count(*) FROM logs";

        if ($conditionString) {
            $sql = $sql . $conditionString;
        }

        $dbResult = Database::makeWithDefaultConfig()
            ->fetch($sql, $bindings);

        return intval($dbResult[0]['count']);
    }

    private function fetchPageData(?string $conditionString, array $bindings, int $page, string $sort): array
    {
        $sql = "SELECT * FROM logs";

        if ($conditionString) {
            $sql = $sql . $conditionString;
        }

        $offset = $page * self::PAGE_LIMIT;
        $sql .= " ORDER BY ts $sort LIMIT " . self::PAGE_LIMIT .  ' OFFSET ' . $offset;

        return Database::makeWithDefaultConfig()
            ->fetch($sql, $bindings);
    }

    private function makeConditionString(LogRequest $request): ?string
    {
        $requestFilters = $request->getFilters();
        if (count($requestFilters) === 0) {
            return null;
        }

        $conditions = [];
        /** @var LogFilter $filter */
        foreach ($requestFilters as $filter) {
            $conditions []= $filter->getKey() . ' ' . $filter->getOperator() . ' ?';
        }

        return ' WHERE ' . implode('AND ', $conditions);
    }
}