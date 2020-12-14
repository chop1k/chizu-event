<?php

namespace Chizu\Event;

class Handlers implements Executable
{
    protected array $handlers;

    /**
     * @return array
     */
    public function getHandlers(): array
    {
        return $this->handlers;
    }

    /**
     * @param array $handlers
     */
    public function setHandlers(array $handlers): void
    {
        $this->handlers = $handlers;
    }

    public function addHandlers(Executable $executable): void
    {
        $this->handlers[] = $executable;
    }

    public function __construct(array $handlers = [])
    {
        $this->handlers = $handlers;
    }

    public function execute(...$args)
    {
        foreach ($this->handlers as $handler)
        {
            $handler->execute(...$args);
        }
    }
}