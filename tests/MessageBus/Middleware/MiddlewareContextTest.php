<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\MessageBus\Middleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Dispatcher\DispatcherInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareContext;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;

final class MiddlewareContextTest extends TestCase
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

        $middlewareContext = new MiddlewareContext([$middleware], $dispatcher);

        $middlewareContext->next('message', $middlewareContext);
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

        /** @var MockObject $item */
        foreach ($middleware as $item) {
            $item->expects($this->once())
                ->method('handle')
                ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) {
                    $handler->next($message, $handler);
                });
        }

        $middlewareContext = new MiddlewareContext($middleware, $dispatcher);

        $middlewareContext->next('message', $middlewareContext);
    }
}
