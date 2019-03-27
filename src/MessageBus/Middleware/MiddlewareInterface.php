<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

interface MiddlewareInterface
{
    /**
     * @param mixed $message
     *
     * @throws MiddlewareException
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void;
}
