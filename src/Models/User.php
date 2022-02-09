<?php

namespace App\Models;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity]
class User
{
    #[Column(type: "primary")]
    public int $id;

    public function __construct(
        #[Column(type: "string")]
        public string $name,
    )
    {
    }
}
