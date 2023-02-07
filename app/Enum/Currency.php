<?php

namespace App\Enum;

/**
 * @method static self RUB()
 * @method static self USD()
 * @method static self EUR()
 */
class Currency extends \Spatie\Enum\Enum
{
    /**
     * @return int[]
     */
    protected static function values(): array
    {
        return [
            'RUB' => 'RUB',
            'USD' => 'USD',
            'EUR' => 'EUR',
        ];
    }


    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'RUB' => 'Рубль',
            'USD' => 'Доллар',
            'EUR' => 'Евро',
        ];
    }
}
