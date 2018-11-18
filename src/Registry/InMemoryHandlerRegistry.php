<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;
use Qlimix\MessageBus\Registry\Exception\HandlerLocatorException;

final class InMemoryHandlerRegistry implements HandlerRegistryInterface, HandlersProviderInterface
{
    /** @var Handler[] */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function register(string $handler, string $messageName, string $method = 'execute'): void
    {
        $this->handlers[$messageName] = new Handler($handler, $method);
    }

    /**
     * @inheritDoc
     */
    public function find(string $messageName): array
    {
        if (!empty($this->handlers[$messageName])) {
            return [$this->handlers[$messageName]];
        }

        throw new HandlerLocatorException('Could not match '.$messageName);
    }
}
