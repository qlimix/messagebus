<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

use Qlimix\MessageBus\Dispatcher\DispatcherInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareContext;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;
use Throwable;

final class MiddlewareMessageBus implements MessageBusInterface
{
    /** @var MiddlewareInterface[] */
    private $middleware;

    /** @var DispatcherInterface */
    private $dispatcher;

    /**
     * @param MiddlewareInterface[] $middleware
     */
    public function __construct(array $middleware, DispatcherInterface $dispatcher)
    {
        $this->middleware = $middleware;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.EmptyCatchBlock)
     */
    public function handle($message): void
    {
        try {
            $context = new MiddlewareContext($this->middleware, $this->dispatcher);
            $context->next($message, $context);
        } catch (Throwable $exception) {
        }
    }
}
