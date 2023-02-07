<?php

namespace App\Data\Casts;

use App\Enum\Currency;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class CurrencyCast implements Cast
{
    /**
     * @param DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return Currency
     */
    public function cast(DataProperty $property, mixed $value, array $context): Currency
    {
        return Currency::from($value);
    }
}
