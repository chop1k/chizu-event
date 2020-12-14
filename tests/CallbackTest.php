<?php

namespace Tests;

use Chizu\Event\Callback;
use PHPUnit\Framework\TestCase;

class CallbackTest extends TestCase
{
    public function getCallbacks(): array
    {
        $callback = function (): string
        {
            return 'callback';
        };

        return [
            [new Callback($callback), 'callback']
        ];
    }

    /**
     * @dataProvider getCallbacks
     * \
     * @param Callback $callback
     * @param string $expected
     */
    public function testExecute(Callback $callback, string $expected): void
    {
        self::assertTrue($callback->execute() === $expected);
    }
}