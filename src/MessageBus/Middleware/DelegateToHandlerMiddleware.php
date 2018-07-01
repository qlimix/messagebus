<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Locator\HandlerRegistryInterface;
use Qlimix\MessageBus\Locator\ServiceLocatorInterface;
use Qlimix\MessageBus\Message\MessageInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

final class DelegateToHandlerMiddleware implements MiddlewareInterface
{
    /** @var HandlerRegistryInterface */
    private $locator;

    /** @var ServiceLocatorInterface */
    private $serviceLocator;

    /**
     * @param HandlerRegistryInterface $locator
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(HandlerRegistryInterface $locator, ServiceLocatorInterface $serviceLocator)
    {
        $this->locator = $locator;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @inheritDoc
     */
    public function handle(MessageInterface $message, MiddlewareHandlerInterface $handler): void
    {
        try {
            $locatedHandler = $this->locator->find(get_class($message));
        } catch (\Throwable $exception) {
            throw new MiddlewareException('Failed to get message handler', 0, $exception);
        }

        try {
            $service = $this->serviceLocator->resolve($locatedHandler->getHandler());
        } catch (\Throwable $exception) {
            throw new MiddlewareException('Failed to resolve handler', 0, $exception);
        }

        try {
            $service->{$locatedHandler->getMethod()}($message);
        } catch (\Throwable $exception) {
            throw new MiddlewareException('Could not call handler associated with message', 0, $exception);
        }
    }
}
