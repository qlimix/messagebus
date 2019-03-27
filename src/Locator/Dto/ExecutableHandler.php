<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator\Dto;

final class ExecutableHandler
{
    /** @var object */
    private $handler;

    /** @var string */
    private $method;

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
