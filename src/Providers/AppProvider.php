<?php

namespace Reflect\Providers;

use Reflect\Provider;
use Reflect\Services\ConversionService;
use Reflect\Services\DefaultConversionService;

class AppProvider extends Provider
{
    public function boot()
    {
        $this->app->container->singleton(
            ConversionService::class,
            DefaultConversionService::class,
        );
    }
}
