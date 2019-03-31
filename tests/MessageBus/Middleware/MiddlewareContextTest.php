<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\MessageBus\Middleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareContext;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareInterface;

final class MiddlewareContextTest extends TestCase
{
    /**
     * @test
     */
    public function shouldHandleMessageWithSingleMiddleware(): void
    {
        $middleware = $this->createMock(MiddlewareInterface::class);

        $middleware->expects($this->once())
            ->method('handle')
            ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) {
                $handler->next($message, $handler);
            });

        $middlewareContext = new MiddlewareContext([$middleware]);

        $middlewareContext->next('message', $middlewareContext);
    }

    /**
     * @test
     */
    public function shouldPassMessageThroughMiddleware(): void
    {
        $middleware = [
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
            $this->createMock(MiddlewareInterface::class),
        ];

        /** @var MockObject $item */
        foreach ($middleware as $item) {
            $item->expects($this->once())
                ->method('handle')
                ->willReturnCallback(static function ($message, MiddlewareHandlerInterface $handler) {
                    $handler->next($message, $handler);
                });
        }

        $middlewareContext = new MiddlewareContext($middleware);

        $middlewareContext->next('message', $middlewareContext);
    }
}
