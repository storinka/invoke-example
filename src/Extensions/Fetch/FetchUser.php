<?php

namespace App\Extensions\Fetch;

use App\Models\User;
use App\Repositories\Users\Users;
use Invoke\Meta\Extension;
use Invoke\Meta\NotParameter;
use Invoke\Meta\Parameter;
use RuntimeException;

#[Extension]
trait FetchUser
{
    use Users;

    #[NotParameter]
    protected User $user;

    #[Parameter]
    public int $userId;

    public function beforeHandleFetchUser()
    {
        $user = $this->users->findByPK($this->userId);

        if (!$user) {
            throw new RuntimeException("User with id \"{$this->userId}\" not found.");
        }

        $this->user = $user;
    }
}