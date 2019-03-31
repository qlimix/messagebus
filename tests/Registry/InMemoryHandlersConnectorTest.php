<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Registry;

use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Registry\InMemoryHandlersConnector;

final class InMemoryHandlersConnectorTest extends TestCase
{
    /**
     * @test
     */
    public function shouldLinkAndFindMultipleHandler(): void
    {
        $message = 'message';
        $handler = 'handler';
        $method = 'execute';

        $handlerConnector = new InMemoryHandlersConnector();
        $handlerConnector->link($handler, $message, $method);
        $handlerConnector->link($handler, $message, $method);

        $foundHandlers = $handlerConnector->find($message);

        foreach ($foundHandlers as $foundHandler) {
            $this->assertSame($foundHandler->getHandler(), $handler);
            $this->assertSame($foundHandler->getMethod(), $method);
        }
    }

    /**
     * @test
     */
    public function shouldLinkAndFindSingleHandler(): void
    {
        $message = 'message';
        $handler = 'handler';
        $method = 'execute';

        $handlerConnector = new InMemoryHandlersConnector();
        $handlerConnector->link($handler, $message, $method);

        $foundHandlers = $handlerConnector->find($message);

        foreach ($foundHandlers as $foundHandler) {
            $this->assertSame($foundHandler->getHandler(), $handler);
            $this->assertSame($foundHandler->getMethod(), $method);
        }
    }

    /**
     * @test
     */
    public function shouldThrowOnNoHandlerFound(): void
    {
        $handlerConnector = new InMemoryHandlersConnector();

        $foundHandlers = $handlerConnector->find('message');

        $this->assertSame([], $foundHandlers);
    }
}
