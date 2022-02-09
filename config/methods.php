<?php

use App\Methods\CreateUser;
use App\Methods\DeleteUser;
use App\Methods\GetUsers;
use App\Methods\UpdateUserName;
use Invoke\Schema\SchemaDocument;

return [
    GetUsers::class,
    CreateUser::class,
    DeleteUser::class,
    UpdateUserName::class,

    "getSchema" => function () {
        return SchemaDocument::current();
    }
];
