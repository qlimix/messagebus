<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;

final class InMemoryHandlersRegistry implements HandlerRegistryInterface, HandlersProviderInterface
{
    /** @var Handler[][] */
    private $handlers = [];

    /**
     * @inheritDoc
     */
    public function register(string $handler, string $messageName, string $method = 'execute'): void
    {
        $this->handlers[$messageName][] = new Handler($handler, $method);
    }

    /**
     * @inheritDoc
     */
    public function find(string $messageName): array
    {
        return !empty($this->handlers[$messageName]) ? $this->handlers[$messageName] : [];
    }
}
