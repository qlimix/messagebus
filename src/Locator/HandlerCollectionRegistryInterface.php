<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\Handler;
use Qlimix\MessageBus\Locator\Exception\HandlerLocatorException;

interface HandlerCollectionRegistryInterface
{
    /**
     * @param string $handler
     * @param string $messageName
     * @param string $method
     */
    public function register(string $handler, string $messageName, string $method = 'execute'): void;

    /**
     * @param string $messageName
     *
     * @return Handler[]
     *
     * @throws HandlerLocatorException
     */
    public function find(string $messageName): array;
}
