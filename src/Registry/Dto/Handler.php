<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry\Dto;

final class Handler
{
    /** @var string */
    private $handler;

    /** @var string */
    private $method;

    /**
     * @param string $handler
     * @param string $method
     */
    public function __construct(string $handler, string $method)
    {
        $this->handler = $handler;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getHandler(): string
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
