<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

final class Connector
{
    /** @var ConnectionInterface[] */
    private $connections;

    /**
     * @param ConnectionInterface[] $connections
     */
    public function __construct(array $connections)
    {
        $this->connections = $connections;
    }

    public function connector(HandlerConnectorInterface $connector): void
    {
        foreach ($this->connections as $connection) {
            $connection->connect($connector);
        }
    }
}
