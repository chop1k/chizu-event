<?php

namespace Chizu\Event;

use ReflectionClass;

class Method implements Executable
{
    protected ?object $instance;

    /**
     * @return object
     */
    public function getInstance(): ?object
    {
        return $this->instance;
    }

    /**
     * @param object|null $instance
     */
    public function setInstance(?object $instance): void
    {
        $this->instance = $instance;
    }

    protected string $method;

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function __construct(?object $instance = null, string $method = "")
    {
        $this->instance = $instance;
        $this->method = $method;
    }

    public function execute(...$args)
    {
        $method = (new ReflectionClass($this->instance))->getMethod($this->method);

        $method->setAccessible(true);

        try
        {
            return $method->invoke($this->instance, ...$args);
        }
        finally
        {
            $method->setAccessible(false);
        }
    }
}