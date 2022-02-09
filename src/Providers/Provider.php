<?php

namespace App\Providers;

use Invoke\Container\Container;
use Invoke\Container\InvokeContainerInterface;
use Invoke\Pipe;

abstract class Provider implements Pipe
{
    public function pass(mixed $value): mixed
    {
        $this->register(Container::getInstance());

        return $value;
    }

    public abstract function register(InvokeContainerInterface $container): void;
}