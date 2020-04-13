<?php declare(strict_types=1);

namespace Qlimix\Tests\MessageBus\Registry\Dto;

use PHPUnit\Framework\TestCase;
use Qlimix\MessageBus\Locator\Dto\ExecutableHandler;
use stdClass;

final class ExecutableHandlerTest extends TestCase
{
    public function testShouldDto(): void
    {
        $object = new stdClass();
        $method = 'foo';

        $executableHandler = new ExecutableHandler($object, $method);

        $this->assertSame($object, $executableHandler->getHandler());
        $this->assertSame($method, $executableHandler->getMethod());
    }
}
