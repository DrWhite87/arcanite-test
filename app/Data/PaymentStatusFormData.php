<?php

namespace App\Data;

use App\Data\Casts\PaymentStatusCast;
use App\Enum\PaymentStatus;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class PaymentStatusFormData extends Data
{
    /**
     * PaymentData constructor.
     * @param PaymentStatus $status
     */
    public function __construct(
        #[WithCast(PaymentStatusCast::class)]
        public PaymentStatus $status
    ) {}
}
