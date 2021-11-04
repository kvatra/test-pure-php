<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

class LogFilter
{
    public const POSSIBLE_FILTERS = [
        'ts_less_than' => '<',
        'ts_more_than' => '>',
        'type' => '=',
        'message' => '=',
    ];

    private string $key;
    private mixed $value;
    private string $operator;

    public function __construct(string $key, mixed $value, string $operator)
    {
        $this->key = $key;
        $this->value = $value;
        $this->operator = $operator;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }
}