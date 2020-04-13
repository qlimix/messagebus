<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator\Dto;

final class ExecutableHandler
{
    private object $handler;

    private string $method;

    public function __construct(object $handler, string $method)
    {
        $this->handler = $handler;
        $this->method = $method;
    }

    public function getHandler(): object
    {
        return $this->handler;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
