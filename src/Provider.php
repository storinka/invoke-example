<?php

namespace Reflect;

class Provider
{
    protected InvokeApp $app;

    public function __construct(InvokeApp $app)
    {
        $this->app = $app;
    }

    public function boot()
    {
        // register services here
    }
}
