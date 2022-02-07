<?php

namespace App\Methods;

use Invoke\Method;

/**
 * Convert int to hex.
 */
class Dec2Hex extends Method
{
    public int $dec;

    public function handle(): string
    {
        return dechex($this->dec);
    }
}
