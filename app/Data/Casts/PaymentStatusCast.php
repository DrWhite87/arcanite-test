<?php

namespace App\Data\Casts;

use App\Enum\PaymentStatus;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class PaymentStatusCast implements Cast
{
    /**
     * @param DataProperty $property
     * @param mixed $value
     * @param array $context
     * @return PaymentStatus
     */
    public function cast(DataProperty $property, mixed $value, array $context): PaymentStatus
    {
        return PaymentStatus::from($value);
    }
}
