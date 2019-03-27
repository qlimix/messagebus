<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Exception\HandlerConnectorException;

interface HandlerConnectorInterface
{
    /**
     * @throws HandlerConnectorException
     */
    public function link(string $handlerName, string $messageName, string $method = 'handle'): void;
}
