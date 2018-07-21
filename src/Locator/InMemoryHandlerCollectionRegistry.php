<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\Handler;

final class InMemoryHandlerCollectionRegistry implements HandlerCollectionRegistryInterface
{
    /** @var Handler[] */
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
        $collection = [];
        foreach ($this->handlers as $message => $handler) {
            if ($message === $messageName) {
                $collection[] = $handler;
            }
        }

        return $collection;
    }
}
