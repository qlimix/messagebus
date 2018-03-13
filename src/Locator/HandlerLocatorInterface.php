<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\Handler;
use Qlimix\MessageBus\Locator\Exception\HandlerLocatorException;

interface HandlerLocatorInterface
{
    /**
     * @param string $handler
     * @param string $messageName
     * @param string $method
     */
    public function registerHandler(string $handler, string $messageName, string $method = 'handle'): void;

    /**
     * @param string $messageName
     *
     * @return Handler
     *
     * @throws HandlerLocatorException
     */
    public function getHandler(string $messageName): Handler;
}
