<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Registry;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Registry\ConnectionInterface;
use Qlimix\MessageBus\Registry\Connector;
use Qlimix\MessageBus\Registry\HandlerConnectorInterface;

final class ConnectorTest extends TestCase
{
    /**
     * @test
     */
    public function shouldConnectSingle(): void
    {
        $connection = $this->createMock(ConnectionInterface::class);

        $handlerConnector = $this->createMock(HandlerConnectorInterface::class);

        $connection->expects($this->once())
            ->method('connect');

        $connector = new Connector([$connection]);

        $connector->connect($handlerConnector);
    }

    /**
     * @test
     */
    public function shouldConnectMultiple(): void
    {
        $connections = [
            $this->createMock(ConnectionInterface::class),
            $this->createMock(ConnectionInterface::class),
            $this->createMock(ConnectionInterface::class),
        ];

        $handlerConnector = $this->createMock(HandlerConnectorInterface::class);

        /** @var MockObject $connection */
        foreach ($connections as $connection) {
            $connection->expects($this->once())
                ->method('connect');
        }

        $connector = new Connector($connections);

        $connector->connect($handlerConnector);
    }
}
