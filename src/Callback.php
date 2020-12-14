<?php

namespace Chizu\Event;

class Callback implements Executable
{
    protected $handler;

    public function __construct(callable $handler)
    {
        $this->handler = $handler;
    }

    public function execute(...$args)
    {
        return ($this->handler)(...$args);
    }
}