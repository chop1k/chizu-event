<?php

namespace Chizu\Event;

use Ds\Map;
use InvalidArgumentException;

class Dispatcher
{
    protected Map $events;

    public function addEvent(string $event, callable $handler): void
    {
        $this->events->put($event, $handler);
    }

    public function addEvents(array $events): void
    {
        foreach ($events as $event => $handler)
        {
            $this->addEvent($event, $handler);
        }
    }

    public function __construct()
    {
        $this->events = new Map();
    }

    public function dispatch(string $event, $data): void
    {
        if (!$this->events->hasKey($event))
        {
            throw new InvalidArgumentException(sprintf('Event with name "%s" not defined', $event));
        }

        $handler = $this->events->get($event);

        $handler($data);
    }
}