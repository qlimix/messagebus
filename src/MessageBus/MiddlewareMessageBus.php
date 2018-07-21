<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;

final class MiddlewareMessageBus implements MessageBusInterface, MiddlewareHandlerInterface
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
    public function handle($message): void
    {
        try {
            $this->next($message, $this);
        } catch (\Throwable $exception) {
        }
    }

    /**
     * @inheritDoc
     */
    public function next($message, MiddlewareHandlerInterface $handler): void
    {
        ++$this->pointer;
        if (!isset($this->middleware[$this->pointer])) {
            $this->pointer = -1;
            return;
        }

        $this->middleware[$this->pointer]->handle($message, $this);
    }
}
