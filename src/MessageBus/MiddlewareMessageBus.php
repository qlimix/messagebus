<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareContext;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;
use Throwable;

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
        try {
            $context = new MiddlewareContext($this->middleware);
            $context->next($message, $context);
        } catch (Throwable $exception) {
        }
    }
}
