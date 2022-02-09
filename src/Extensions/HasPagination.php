<?php

namespace App\Extensions;

interface HasPagination
{
    public function getPage(): int;

    public function getPerPage(): int;
}