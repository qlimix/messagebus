<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

final class MiddlewareContext implements MiddlewareHandlerInterface
{
    /** @var MiddlewareInterface[] */
    private $middleware;

    /** @var int */
    private $pointer = -1;

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
    public function next($message, MiddlewareHandlerInterface $handler): void
    {
        $this->pointer++;
        if (!isset($this->middleware[$this->pointer])) {
            return;
        }

        $this->middleware[$this->pointer]->handle($message, $handler);
    }
}
