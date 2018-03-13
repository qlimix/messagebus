<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\MessageBus\Locator\HandlerLocatorInterface;
use Qlimix\MessageBus\Locator\ServiceLocatorInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;

final class DelegateToHandlerMiddleware implements MiddlewareInterface
{
    /** @var HandlerLocatorInterface */
    private $locator;

    /** @var ServiceLocatorInterface */
    private $serviceLocator;

    /**
     * @param HandlerLocatorInterface $locator
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(HandlerLocatorInterface $locator, ServiceLocatorInterface $serviceLocator)
    {
        $this->locator = $locator;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @inheritDoc
     */
    public function handle($message, MiddlewareHandlerInterface $handler): void
    {
        try {
            $locatedHandler = $this->locator->getHandler(\get_class($message));
            $service = $this->serviceLocator->resolve($locatedHandler->getHandler());
        } catch (\Exception $exception) {
            throw new MiddlewareException('Failed to get message handler', 0, $exception);
        }

        try {
            $service->{$locatedHandler->getMethod()}($message);
        } catch (\Throwable $exception) {
            throw new MiddlewareException('Could not call handler associated with message', 0, $exception);
        }
    }
}
