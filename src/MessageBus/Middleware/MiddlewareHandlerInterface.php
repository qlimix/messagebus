<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

interface MiddlewareHandlerInterface
{
    /**
     * @param mixed $message
     * @param MiddlewareHandlerInterface $handler
     */
    public function next($message, MiddlewareHandlerInterface $handler): void;
}
