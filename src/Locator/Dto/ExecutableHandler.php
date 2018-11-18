<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator\Dto;

final class ExecutableHandler
{
    /** @var object */
    private $handler;

    /** @var string */
    private $method;

    /**
     * @param object $handler
     * @param string $method
     */
    public function __construct(object $handler, string $method)
    {
        $this->handler = $handler;
        $this->method = $method;
    }

    /**
     * @return object
     */
    public function getHandler(): object
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
