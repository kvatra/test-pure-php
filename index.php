<?php

require_once 'vendor/autoload.php';

use App\ToHtml;
use App\HtmlTemplate;
use App\LogsHtmlView\{
    Filters,
    Table,
    Pagination
};
use App\Infrastructure\DTO\LogRequest;
use App\Infrastructure\Services\LogRetriever;

$logsRequest = LogRequest::makeFromCurrentRequest();
$logsPage = (new LogRetriever())->fetch($logsRequest);


$components = [
    new Filters($logsRequest->getFilters()),
    new Pagination($logsPage),
    new Table($logsPage->getCurrentPageData()),
];

$view = new HtmlTemplate($components);
echo $view->makeHtml();