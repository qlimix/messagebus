<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\MessageBus\Middleware;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Dispatcher\MessageDispatcherInterface;
use Qlimix\MessageBus\MessageBus\Middleware\DispatchMessageMiddleware;
use Qlimix\MessageBus\MessageBus\Middleware\MiddlewareHandlerInterface;

final class DispatchMessageMiddlewareTest extends TestCase
{
    /** @var MockObject */
    private $dispatcher;

    /** @var DispatchMessageMiddleware */
    private $middleware;

    protected function setUp()
    {
        $this->dispatcher = $this->createMock(MessageDispatcherInterface::class);
        $this->middleware = new DispatchMessageMiddleware($this->dispatcher);
    }

    /**
     * @test
     */
    public function shouldDispatch(): void
    {
        $this->dispatcher->expects($this->once())
            ->method('dispatch');

        $this->middleware->handle(
            'message',
            $this->createMock(MiddlewareHandlerInterface::class)
        );
    }

    /**
     * @test
     */
    public function shouldThrowOnDispatchException(): void
    {
        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->willThrowException(new Exception());

        $this->expectException(Exception::class);

        $this->middleware->handle(
            'message',
            $this->createMock(MiddlewareHandlerInterface::class)
        );
    }
}
