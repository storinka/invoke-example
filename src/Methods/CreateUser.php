<?php

namespace App\Methods;

use App\Data\UserResult;
use App\Repositories\Users\Users;
use Invoke\Meta\Parameter;
use Invoke\Method;
use Invoke\Validators\Length;

/**
 * Create new user.
 */
class CreateUser extends Method
{
    use Users;

    #[Parameter]
    #[Length(min: 3, max: 32)]
    public string $name;

    protected function handle(): UserResult
    {
        $user = $this->users->create($this->name);

        return UserResult::from($user);
    }
}