<?php

namespace Chizu\Event;

class Event
{
    protected bool $singleton;

    /**
     * @return bool
     */
    public function isSingleton(): bool
    {
        return $this->singleton;
    }

    /**
     * @param bool $singleton
     */
    public function setSingleton(bool $singleton): void
    {
        $this->singleton = $singleton;
    }

    protected array $handlers;

    public function addHandler(callable $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function __construct(array $handlers = [], bool $singleton = false)
    {
        $this->handlers = [];

        foreach ($handlers as $handler)
        {
            if (is_callable($handler))
            {
                $this->addHandler($handler);
            }
        }

        $this->singleton = $singleton;
    }

    public function execute(...$data)
    {
        if ($this->isSingleton())
        {
            return $this->handlers[0](...$data);
        }
        else
        {
            foreach ($this->handlers as $handler)
            {
                $handler(...$data);
            }

            return null;
        }
    }
}