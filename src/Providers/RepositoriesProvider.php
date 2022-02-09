<?php

namespace App\Providers;

use App\Repositories\Users\UsersRepository;
use Invoke\Container\InvokeContainerInterface;

class RepositoriesProvider extends Provider
{
    public function register(InvokeContainerInterface $container): void
    {
        $container->singleton(UsersRepository::class);
    }
}