<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\MessageBus\Middleware;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Dispatcher\DispatcherInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;
use Qlimix\MessageBus\MessageBus\MiddlewareMessageBus;

final class MiddlewareMessageBusTest extends TestCase
{
    public function testShouldHandleMessageWithSingleMiddleware(): void
    {
        $middleware = $this->createMock(MiddlewareInterface::class);

        $middleware->expects($this->once())
            ->method('handle')
            ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) {
                $handler->next($message, $handler);
            });

        $dispatcher = $this->createMock(DispatcherInterface::class);

        $dispatcher->expects($this->once())
            ->method('dispatch');

        $messageBus = new MiddlewareMessageBus([$middleware], $dispatcher);

        $messageBus->handle('message');
    }

    public function testShouldPassMessageThroughMiddleware(): void
    {
        $middleware = [
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
        ];

        $dispatcher = $this->createMock(DispatcherInterface::class);

        $dispatcher->expects($this->once())
            ->method('dispatch');

        foreach ($middleware as $item) {
            $item->expects($this->once())
                ->method('handle')
                ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) {
                    $handler->next($message, $handler);
                });
        }

        $messageBus = new MiddlewareMessageBus($middleware, $dispatcher);


        $messageBus->handle('message');
    }

    public function testShouldHandleMiddlewareInOrder(): void
    {
        $middleware = [
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
        ];

        $dispatcher = $this->createMock(DispatcherInterface::class);

        $dispatcher->expects($this->once())
            ->method('dispatch');

        $order = [];

        $i = 0;
        /** @var MockObject $item */
        foreach ($middleware as $item) {
            $item->expects($this->once())
                ->method('handle')
                ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) use (&$order, &$i) {
                    $order[] = $i++;
                    $handler->next($message, $handler);
                });
        }

        $messageBus = new MiddlewareMessageBus($middleware, $dispatcher);

        $messageBus->handle('message');
        $this->assertEquals([0, 1, 2], $order);
    }

    public function testShouldNeverThrow(): void
    {
        $middleware = $this->createMock(MiddlewareInterface::class);

        $dispatcher = $this->createMock(DispatcherInterface::class);

        $middleware->expects($this->once())
            ->method('handle')
            ->willThrowException(new Exception());

        $messageBus = new MiddlewareMessageBus([$middleware], $dispatcher);

        $messageBus->handle('message');
    }
}
