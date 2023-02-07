<?php

namespace App\Data;

use App\Data\Casts\PasswordCast;
use App\Data\Casts\PhoneCast;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Same;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class UserFormData extends Data
{
    /**
     * UserRegisterData constructor.
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param string $passwordConfirmation
     */
    public function __construct(
        #[Max(50), Regex('/^[\w0-9\+\.]+$/i')]
        public string $name,
        #[Unique('users', 'email'), Email]
        public string $email,
        #[WithCast(PhoneCast::class), Regex('/^[0-9\+]+$/i'), Min(9), Max(13)]
        public string $phone,
        #[WithCast(PasswordCast::class), Min(6), Max(20)]
        public string $password,
        #[MapInputName('password_confirmation'), Min(6), Max(20), Same('password')]
        public string $passwordConfirmation
    )
    {
    }

    /**
     * @return string[]
     */
    public static function messages(): array
    {
        return [
            'name.required' => 'Укажите ФИО',
            'name.regex' => 'Только латинские буквы, цифры и точка',
            'email.required' => 'Укажите Email',
            'email.email' => 'Нужна действующая электронная почта',
            'email.unique' => 'Электронная почта уже занята',
            'phone.required' => 'Укажите Телефон',
            'phone.regex' => 'Нужен действующий телефон',
            'phone.min' => 'Минимум :min символов',
            'phone.max' => 'Максимум :max символов',
            'password.required' => 'Укажите пароль',
            'password.min' => 'Минимум :min символов',
            'password.max' => 'Максимум :max символов',
            'password_confirmation.required' => 'Подтвердите пароль',
            'password_confirmation.some' => 'Пароли не совпадают',
        ];
    }
}
