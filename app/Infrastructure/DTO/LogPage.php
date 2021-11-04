<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

class LogPage
{
    private array $currentPageData;
    private int $currentPage;
    private bool $prevPageExists;
    private bool $nextPageExists;

    public function __construct(array $currentPageData, int $currentPage, bool $prevPageExists, bool $nextPageExists)
    {
        $this->currentPageData = $currentPageData;
        $this->currentPage = $currentPage;
        $this->prevPageExists = $prevPageExists;
        $this->nextPageExists = $nextPageExists;
    }

    public function getCurrentPageData(): array
    {
        return $this->currentPageData;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function isPrevPageExists(): bool
    {
        return $this->prevPageExists;
    }

    public function isNextPageExists(): bool
    {
        return $this->nextPageExists;
    }
}