<?php

namespace App\Repositories\Users;

use Invoke\Meta\Inject;

trait Users
{
    #[Inject]
    protected UsersRepository $users;
}