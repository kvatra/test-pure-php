<?php

declare(strict_types=1);

namespace App;

use App\ToHtml;

class HtmlTemplate implements ToHtml
{
    private array $toHtmlComponents;

    public function __construct(array $toHtmlComponents)
    {
        $this->toHtmlComponents = $toHtmlComponents;
    }

    public function makeHtml(): string
    {
        $componentsHtml = array_map(fn(ToHtml $toHtml) => $toHtml->makeHtml(), $this->toHtmlComponents);

        return $this->makeBodyStart()
            . implode('', $componentsHtml)
            . $this->makeBodyEnd();
    }

    private function makeBodyStart(): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
td {
  min-width:200px
}
</style>
<script>
  window.onload = function() {
    const queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    
    document.getElementById('filter_type').value = urlParams.get('type')
    document.getElementById('current_page_number').value = urlParams.get('page') 
  }
  
  function sortTable(sortType) {
    const queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    urlParams.set('sort', sortType)
    
    let redirectUrl = window.location.href.split('?')[0]
    redirectUrl = redirectUrl + '?' + urlParams.toString()
    
    window.location = redirectUrl
  }

  function applyFilters() {
    const filterValue = document.getElementById('filter_type').value
    const queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    
    if (filterValue !== '') {
      urlParams.set('type', filterValue)
    } else {
      urlParams.delete('type')
    }
    
    let redirectUrl = window.location.href.split('?')[0]
    redirectUrl = redirectUrl + '?' + urlParams.toString()
    
    window.location = redirectUrl
  }
  
  function nextPage()
  {
    let currentPage = document.getElementById('current_page_number').value
    if (currentPage === '') {
      currentPage = 0;
    }
    
    const queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    urlParams.set('page', parseInt(currentPage) + 1)
    
    let redirectUrl = window.location.href.split('?')[0]
    redirectUrl = redirectUrl + '?' + urlParams.toString()
    
    window.location = redirectUrl
  }
  
  function prevPage()
  {
    let currentPage = document.getElementById('current_page_number').value
    if (currentPage === '') {
      currentPage = 0;
    }
    
    const queryString = window.location.search;
    let urlParams = new URLSearchParams(queryString);
    urlParams.set('page', parseInt(currentPage) - 1)
    
    let redirectUrl = window.location.href.split('?')[0]
    redirectUrl = redirectUrl + '?' + urlParams.toString()
    
    window.location = redirectUrl
  }
</script>
<body>
HTML;
    }

    private function makeBodyEnd(): string
    {
        return <<<HTML
</body>
</html>
HTML;

    }
}