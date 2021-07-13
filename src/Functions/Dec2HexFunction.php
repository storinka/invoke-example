<?php

namespace App\Functions;

use App\AppFunction;
use Invoke\Typesystem\Types;

/**
 * Convert an integer to hexadecimal.
 */
class Dec2HexFunction extends AppFunction
{
    public static function params(): array
    {
        return [
            "dec" => Types::Int,
        ];
    }

    public function handle(int $dec): string
    {
        return dechex($dec);
    }
}
