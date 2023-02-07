<?php

namespace App\Enum;

/**
 * @method static self not_paid()
 * @method static self paid()
 */
class PaymentStatus extends \Spatie\Enum\Enum
{
    /**
     * @return int[]
     */
    protected static function values(): array
    {
        return [
            'not_paid' => 1,
            'paid' => 2,
        ];
    }


    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'not_paid' => 'Не оплачен',
            'paid' => 'Оплачен',
        ];
    }
}
