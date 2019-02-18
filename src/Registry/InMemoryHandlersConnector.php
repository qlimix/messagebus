<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;

final class InMemoryHandlersConnector implements HandlerConnectorInterface, HandlersProviderInterface
{
    /** @var Handler[][] */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function link(string $handlerName, string $messageName, string $method = 'handle'): void
    {
        $this->handlers[$messageName][] = new Handler($handlerName, $method);
    }

    /**
     * @inheritDoc
     */
    public function find(string $messageName): array
    {
        return !empty($this->handlers[$messageName]) ? $this->handlers[$messageName] : [];
    }
}
