<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Message\MessageInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

interface MiddlewareHandlerInterface
{
    /**
     * @param MessageInterface $message
     * @param MiddlewareHandlerInterface $handler
     *
     * @throws MiddlewareException
     */
    public function next(MessageInterface $message, MiddlewareHandlerInterface $handler): void;
}
