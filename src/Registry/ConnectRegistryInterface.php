<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

interface ConnectRegistryInterface
{
    public function register(ConnectInterface $connect): void;
}
