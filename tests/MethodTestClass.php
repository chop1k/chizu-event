<?php

namespace Tests;

class MethodTestClass
{
    public function publicMethod(): string
    {
        return 'public';
    }

    protected function protectedMethod(): string
    {
        return 'protected';
    }

    private function privateMethod(): string
    {
        return 'private';
    }
}