<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

interface MiddlewareHandlerInterface
{
    /**
     * @param mixed $message
     *
     * @throws MiddlewareException
     */
    public function next($message, MiddlewareHandlerInterface $handler): void;
}
