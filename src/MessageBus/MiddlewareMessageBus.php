<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandler;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;
use Qlimix\MessageBus\MessageBusInterface;

final class MiddlewareMessageBus implements MessageBusInterface
{
    /** @var MiddlewareInterface[] */
    private $middleware;

    /**
     * @param MiddlewareInterface[] $middleware
     */
    public function __construct(array $middleware)
    {
        $this->middleware = $middleware;
    }

    /**
     * @inheritDoc
     */
    public function handle($message): void
    {
        $handler = new MiddlewareHandler($this->middleware);

        $handler->next($message, $handler);
    }
}
