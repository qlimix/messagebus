<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\Handler;
use Qlimix\MessageBus\Locator\Exception\HandlerLocatorException;

final class InMemoryHandlerRegistry implements HandlerRegistryInterface
{
    /** @var Handler[] */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function registerHandler(string $handler, string $messageName, string $method = 'handle'): void
    {
        $this->handlers[$messageName] = new Handler($handler, $method);
    }

    /**
     * @inheritDoc
     */
    public function find(string $messageName): Handler
    {
        foreach ($this->handlers as $message => $handler) {
            if ($message === $messageName) {
                return $handler;
            }
        }

        throw new HandlerLocatorException('Could not match '.$messageName);
    }
}
