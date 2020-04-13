<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry\Dto;

final class Handler
{
    private string $handler;

    private string $method;

    public function __construct(string $handler, string $method)
    {
        $this->handler = $handler;
        $this->method = $method;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
