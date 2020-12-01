<?php

namespace Chizu\Event;

use Ds\Map;
use InvalidArgumentException;

class Dispatcher
{
    protected Map $events;

    public function has(string $event): bool
    {
        return $this->events->hasKey($event);
    }

    public function set(string $name, Event $event): void
    {
        $this->events->put($name, $event);
    }

    public function get(string $name): Event
    {
        return $this->events->get($name);
    }

    public function __construct(array $values = [])
    {
        $this->events = new Map($values);
    }

    public function dispatch(string $event, ...$data)
    {
        if (!$this->events->hasKey($event))
        {
            throw new InvalidArgumentException(sprintf('Event with name "%s" not defined', $event));
        }

        return $this->events->get($event)->execute(...$data);
    }
}