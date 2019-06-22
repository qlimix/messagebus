<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Dispatcher\DispatcherInterface;
use Qlimix\MessageBus\Dispatcher\Exception\DispatcherException;

final class MiddlewareContext implements MiddlewareHandlerInterface
{
    /** @var MiddlewareInterface[] */
    private $middleware;

    /** @var DispatcherInterface */
    private $dispatcher;

    /** @var int */
    private $pointer = -1;

    /**
     * @param MiddlewareInterface[] $middleware
     */
    public function __construct(array $middleware, DispatcherInterface $dispatcher)
    {
        $this->middleware = $middleware;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @throws DispatcherException
     *
     * @inheritDoc
     */
    public function next($message, MiddlewareHandlerInterface $handler): void
    {
        $this->pointer++;
        if (!isset($this->middleware[$this->pointer])) {
            $this->dispatcher->dispatch($message);
            return;
        }

        $this->middleware[$this->pointer]->handle($message, $handler);
    }
}
