<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Message\MessageInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

interface MiddlewareInterface
{
    /**
     * @param MessageInterface $message
     * @param MiddlewareHandlerInterface $handler
     *
     * @throws MiddlewareException
     */
    public function handle(MessageInterface $message, MiddlewareHandlerInterface $handler): void;
}
