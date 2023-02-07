<?php

namespace App\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PhoneCast implements Cast
{
    /**
     * @param DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return string
     */
    public function cast(DataProperty $property, mixed $value, array $context): string
    {
        return preg_replace('#[^0-9]#', '', $value);
    }
}
