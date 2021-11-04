<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

class LogRequest
{
    private array $filters;
    private int $page;
    private string $sort;

    public function __construct(array $filters, string $page, string $sort)
    {
        $this->filters = $filters;
        $this->page = intval($page);
        $this->sort = $sort;
    }

    public static function makeFromCurrentRequest(): self
    {
        $filters = [];
        foreach (LogFilter::POSSIBLE_FILTERS as $possibleFilter => $operator) {
            if (!isset($_GET[$possibleFilter])) {
                continue;
            }

            $filters[]= new LogFilter($possibleFilter, $_GET[$possibleFilter], $operator);
        }

        $page = $_GET['page'] ?? '0';
        $sort = $_GET['sort'] ?? 'desc';

        return new self($filters, $page, $sort);
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getSort(): string
    {
        return $this->sort;
    }
}