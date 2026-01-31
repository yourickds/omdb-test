<?php

class Container
{
    private array $bindings = [];

    public function bind($interface, $implement): void
    {
        $this->bindings[$interface] = $implement;
    }

    public function make($interface): mixed
    {
        $class = $this->bindings[$interface];
        return new $class();
    }
}