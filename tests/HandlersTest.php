<?php

namespace Tests;

use Chizu\Event\Callback;
use Chizu\Event\Handlers;
use PHPUnit\Framework\TestCase;

class HandlersTest extends TestCase
{
    public function getHandlers(): array
    {
        $handlers = new Handlers();

        $handlers->setHandlers([
            new Callback(function () {
                echo '1';
            }),
            new Callback(function () {
                echo '2';
            }),
            new Callback(function () {
                echo '3';
            })
        ]);

        return [
            [$handlers, '123']
        ];
    }

    /**
     * @dataProvider getHandlers
     *
     * @param Handlers $handlers
     * @param string $expected
     */
    public function testExecute(Handlers $handlers, string $expected): void
    {
        $this->expectOutputString($expected);

        $handlers->execute();
    }
}