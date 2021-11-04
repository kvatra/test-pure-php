<?php

declare(strict_types=1);

namespace App\LogsHtmlView;

use App\ToHtml;

class Filters implements ToHtml
{
    private array $chosenFilters;

    public function __construct(array $chosenFilters = [])
    {
        $this->chosenFilters = $chosenFilters;
    }

    public function makeHtml(): string
    {
        return <<<HTML
<h2>
Фильтры: 
</h2>
<p>
  <b>Тип:</b><br>
  <input type="text" id="filter_type" size="10">
  <button onclick="applyFilters()" >Применить</button>
</p>
HTML;
    }
}