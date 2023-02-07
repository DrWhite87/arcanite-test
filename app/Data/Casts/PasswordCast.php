<?php

namespace App\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PasswordCast implements Cast
{
    /**
     * @param DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return string
     */
    public function cast(DataProperty $property, mixed $value, array $context): string
    {
        return bcrypt($value);
    }
}
