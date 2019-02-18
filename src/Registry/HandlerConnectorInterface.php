<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

interface HandlerConnectorInterface
{
    public function link(string $handlerName, string $messageName, string $method = 'handle'): void;
}
