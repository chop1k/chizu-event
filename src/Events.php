<?php

namespace Chizu\Event;

use Ds\Map;

class Events
{
    protected Map $events;

    /**
     * @return Map
     */
    public function getMap(): Map
    {
        return $this->events;
    }

    public function has(string $name): bool
    {
        return $this->events->hasKey($name);
    }

    public function set(string $name, Event $event): void
    {
        $this->events->put($name, $event);
    }

    public function get(string $name): Event
    {
        return $this->events->get($name);
    }

    public function __construct($events = [])
    {
        $this->events = new Map($events);
    }
}