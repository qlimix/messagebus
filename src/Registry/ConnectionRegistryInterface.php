<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

interface ConnectionRegistryInterface
{
    public function register(ConnectionInterface $connect): void;
}
