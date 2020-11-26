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

    public function override(string $event, $handlers): void
    {
        $this->events->put($event, $handlers);
    }

    public function __construct(array $values = [])
    {
        $this->events = new Map($values);
    }

    public function dispatch(string $event, $data): void
    {
        if (!$this->events->hasKey($event))
        {
            throw new InvalidArgumentException(sprintf('Event with name "%s" not defined', $event));
        }

        $handler = $this->events->get($event);

        if (is_array($handler))
        {
            foreach ($handler as $func)
            {
                $func($data);
            }
        }
        elseif (is_callable($handler))
        {
            $handler($data);
        }
    }

    public function listen(string $event, callable $handler): void
    {
        if (!$this->events->hasKey($event))
        {
            $this->events->put($event, [$handler]);
        }
        else
        {
            $listeners = $this->events->get($event);

            $listeners[] = $handler;

            $this->events->put($event, $listeners);
        }
    }
}