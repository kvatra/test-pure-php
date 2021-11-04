<?php

declare(strict_types=1);

namespace App\LogsHtmlView;

use App\Infrastructure\DTO\LogPage;
use App\ToHtml;

class Pagination implements ToHtml
{
    private LogPage $currentLogPage;

    public function __construct(LogPage $currentLogPage)
    {
        $this->currentLogPage = $currentLogPage;
    }

    public function makeHtml(): string
    {
        $html = 'Навигация: </h2><p>';

        if ($this->currentLogPage->isPrevPageExists()) {
            $html .= '<button onclick="prevPage()" ><strong> < </button>';
        }

        $html .= '<input type="text" id="current_page_number" size="10">';

        if ($this->currentLogPage->isNextPageExists()) {
            $html .= '<button onclick="nextPage()" ><strong> > </button>';
        }

        $html .= '</p>';

        return $html;
    }
}