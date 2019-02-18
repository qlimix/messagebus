<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;
use Qlimix\MessageBus\Registry\Exception\HandlerProviderException;

final class InMemoryHandlerConnector implements HandlerConnectorInterface, HandlersProviderInterface
{
    /** @var Handler[] */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function link(string $handlerName, string $messageName, string $method = 'handle'): void
    {
        $this->handlers[$messageName] = new Handler($handlerName, $method);
    }

    /**
     * @inheritDoc
     */
    public function find(string $messageName): array
    {
        if (!empty($this->handlers[$messageName])) {
            return [$this->handlers[$messageName]];
        }

        throw new HandlerProviderException('Could not match '.$messageName);
    }
}
