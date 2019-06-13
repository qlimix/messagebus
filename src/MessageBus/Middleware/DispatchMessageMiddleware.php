<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Dispatcher\MessageDispatcherInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Throwable;

final class DispatchMessageMiddleware implements MiddlewareInterface
{
    /** @var MessageDispatcherInterface */
    private $dispatcher;

    public function __construct(MessageDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inheritDoc
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void
    {
        try {
            $this->dispatcher->dispatch($message);
        } catch (Throwable $exception) {
            throw new MiddlewareException('Failed to get message handler', 0, $exception);
        }
    }
}
