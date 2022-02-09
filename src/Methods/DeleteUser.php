<?php

namespace App\Methods;

use App\Extensions\Fetch\FetchUser;
use Invoke\Method;

/**
 * Delete user.
 */
class DeleteUser extends Method
{
    use FetchUser;

    protected function handle(): void
    {
        $this->users->delete($this->user);
    }
}