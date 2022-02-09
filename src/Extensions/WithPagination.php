<?php

namespace App\Extensions;

use Invoke\Meta\Parameter;

trait WithPagination
{
    #[Parameter]
    public int $page = 1;

    #[Parameter]
    public int $perPage = 10;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }
}