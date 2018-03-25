<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

use Qlimix\MessageBus\Message\MessageInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;
use Qlimix\MessageBus\MessageBusInterface;

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
    public function handle(MessageInterface $message): void
    {
        try {
            $this->next($message, $this);
        } catch (\Throwable $exception) {
        }
    }

    /**
     * @inheritDoc
     */
    public function next(MessageInterface $message, MiddlewareHandlerInterface $handler): void
    {
        ++$this->pointer;
        if (!isset($this->middleware[$this->pointer])) {
            $this->pointer = -1;
            return;
        }

        $this->middleware[$this->pointer]->handle($message, $this);
    }
}
