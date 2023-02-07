<?php

namespace App\Data;

use App\Data\Casts\CurrencyCast;
use App\Data\Casts\PaymentStatusCast;
use App\Enum\Currency;
use App\Enum\PaymentStatus;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class PaymentStoreData extends Data
{
    /**
     * PaymentData constructor.
     * @param int $user_id
     * @param string $requisites
     * @param float $amount
     * @param Currency $currency
     */
    public function __construct(
        public int $user_id,
        #[Max(5000)]
        public string $requisites,
        #[Between(0,99999999.99)]
        public float $amount,
        #[WithCast(CurrencyCast::class)]
        public Currency $currency
    ) {}

    /**
     * @return string[]
     */
    public static function messages(): array
    {
        return [
            'user_id.required' => 'Укажите Логин',
            'requisites.required' => 'Укажите Реквизиты',
            'amount.required' => 'Укажите Сумму',
            'amount.between' => 'Сумма должна находиться в диапазоне от 0 до 99999999.99',
            'currency.required' => 'Укажите Валюту',
        ];
    }
}
