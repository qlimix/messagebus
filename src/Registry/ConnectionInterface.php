<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

interface ConnectionInterface
{
    public function connect(HandlerConnectorInterface $connector): void;
}
