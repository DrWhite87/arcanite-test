<?php

namespace App\Data;

use App\Data\Casts\CurrencyCast;
use App\Data\Casts\PaymentStatusCast;
use App\Enum\Currency;
use App\Enum\PaymentStatus;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation\DigitsBetween;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class PaymentData extends Data
{
    /**
     * PaymentData constructor.
     * @param int $id
     * @param int $user_id
     * @param string $requisites
     * @param float $amount
     * @param Currency $currency
     * @param PaymentStatus $status
     * @param Carbon $created_at
     * @param UserData|Optional $user
     */
    public function __construct(
        public int $id,
        public int $user_id,
        #[Max(5000)]
        public string $requisites,
        #[DigitsBetween(0,99999999.99)]
        public float $amount,
        #[WithCast(CurrencyCast::class)]
        public Currency $currency,
        #[WithCast(PaymentStatusCast::class)]
        public PaymentStatus $status,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y/m/d H:i:s')]
        public Carbon $created_at,
        public UserData|Optional $user,
    ) {}
}
