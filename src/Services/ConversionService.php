<?php

namespace Reflect\Services;

interface ConversionService
{
    public function dec2hex(int $dec): string;
}
