<?php

namespace Chizu\Event;

interface Executable
{
    public function execute(...$args);
}