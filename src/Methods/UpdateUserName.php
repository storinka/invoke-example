<?php

namespace App\Methods;

use App\Data\UserResult;
use App\Extensions\Fetch\FetchUser;
use Invoke\Meta\Parameter;
use Invoke\Method;
use Invoke\Validators\Length;

/**
 * Update user's name.
 */
class UpdateUserName extends Method
{
    use FetchUser;

    #[Parameter]
    #[Length(min: 3, max: 32)]
    public string $name;

    protected function handle(): UserResult
    {
        $user = $this->users->updateName(
            $this->user,
            $this->name
        );

        return UserResult::from($user);
    }
}