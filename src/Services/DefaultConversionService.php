<?php

namespace Reflect\Services;

class DefaultConversionService implements ConversionService
{
    public function dec2hex(int $dec): string
    {
        return dechex($dec);
    }
}
