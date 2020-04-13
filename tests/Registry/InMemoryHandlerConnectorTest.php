<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Registry;

use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Registry\Exception\HandlerConnectorException;
use Qlimix\MessageBus\Registry\Exception\HandlerProviderException;
use Qlimix\MessageBus\Registry\InMemoryHandlerConnector;

final class InMemoryHandlerConnectorTest extends TestCase
{
    public function testShouldLinkAndFindHandler(): void
    {
        $message = 'message';
        $handler = 'handler';
        $method = 'execute';

        $handlerConnector = new InMemoryHandlerConnector();
        $handlerConnector->link($handler, $message, $method);

        $foundHandler = $handlerConnector->find($message);

        $this->assertSame($foundHandler->getHandler(), $handler);
        $this->assertSame($foundHandler->getMethod(), $method);
    }

    public function testShouldThrowOnDuplicateMessageHandler(): void
    {
        $message = 'message';
        $handler = 'handler';
        $method = 'execute';

        $handlerConnector = new InMemoryHandlerConnector();
        $handlerConnector->link($handler, $message, $method);

        $this->expectException(HandlerConnectorException::class);
        $handlerConnector->link('other', $message);
    }

    public function testShouldThrowOnNoHandlerFound(): void
    {
        $handlerConnector = new InMemoryHandlerConnector();

        $this->expectException(HandlerProviderException::class);

        $handlerConnector->find('message');
    }
}
