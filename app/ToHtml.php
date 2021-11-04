<?php

declare(strict_types=1);

namespace App;

interface ToHtml
{
    public function makeHtml(): string;
}