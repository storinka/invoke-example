<?php

namespace Reflect\Functions;

use Invoke\InvokeFunction;
use Invoke\Typesystem\Type;
use Reflect\Services\ConversionService;

class Dec2HexFunction extends InvokeFunction
{
    protected ConversionService $conversionService;

    public function __construct(ConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }

    public static function params(): array
    {
        return [
            "dec" => Type::Int,
        ];
    }

    public function handle(int $dec): string
    {
        return $this->conversionService->dec2hex($dec);
    }
}
