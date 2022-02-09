<?php

namespace App\Methods;

use App\Data\UserResult;
use App\Extensions\HasPagination;
use App\Extensions\WithPagination;
use App\Repositories\Users\Users;
use Invoke\Method;

/**
 * Get list of users.
 */
class GetUsers extends Method implements HasPagination
{
    use Users, WithPagination;

    protected function handle(): array
    {
        $users = $this->users->findAllWithPagination($this);

        return UserResult::many($users);
    }
}