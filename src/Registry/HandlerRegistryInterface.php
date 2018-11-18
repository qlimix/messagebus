<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

interface HandlerRegistryInterface
{
    /**
     * @param string $handler
     * @param string $messageName
     * @param string $method
     */
    public function register(string $handler, string $messageName, string $method = 'execute'): void;
}
