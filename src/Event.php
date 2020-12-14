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

    protected ?Executable $handler;

    /**
     * @return Executable
     */
    public function getHandler(): ?Executable
    {
        return $this->handler;
    }

    /**
     * @param Executable $handler
     */
    public function setHandler(Executable $handler): void
    {
        $this->handler = $handler;
    }

    public function __construct()
    {
        $this->handler = null;
        $this->singleton = false;
    }

    public static function createByCallback(callable $callback): Event
    {
        $event = new Event();

        $event->setSingleton(true);
        $event->setHandler(new Callback($callback));

        return $event;
    }

    public static function createByMethod(object $instance, string $method): Event
    {
        $event = new Event();

        $event->setSingleton(true);
        $event->setHandler(new Method($instance, $method));

        return $event;
    }

    public static function createByMany(Executable ...$executable): Event
    {
        $event = new Event();

        $event->setSingleton(false);
        $event->setHandler(new Handlers($executable));

        return $event;
    }
}