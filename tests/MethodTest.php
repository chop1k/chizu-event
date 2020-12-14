<?php

namespace Tests;

use Chizu\Event\Method;
use PHPUnit\Framework\TestCase;

class MethodTest extends TestCase
{
    public function getClasses(): array
    {
        return [
            [new Method(new MethodTestClass(), 'publicMethod'), 'public'],
            [new Method(new MethodTestClass(), 'protectedMethod'), 'protected'],
            [new Method(new MethodTestClass(), 'privateMethod'), 'private']
        ];
    }

    /**
     * @dataProvider getClasses
     *
     * @param Method $method
     * @param string $expected
     */
    public function testExecute(Method $method, string $expected): void
    {
        self::assertTrue($method->execute() === $expected);
    }
}