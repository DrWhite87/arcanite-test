<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    /**
     * UserData constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $phone
     */
    public function __construct(
        public int $id,
        #[Max(150)]
        public string $name,
        #[Email]
        public string $email,
        #[Regex('/^[0-9]+$/i'), Min(9), Max(13)]
        public string $phone
    )
    {
    }
}
