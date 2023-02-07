<?php

namespace Database\Factories;

use App\Enum\Currency;
use App\Enum\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'requisites' => fake()->text(),
            'amount' =>  fake()->randomFloat(2, 100, 9999),
            'currency' => fake()->randomElement(Currency::toValues()),
            'status' => fake()->randomElement(PaymentStatus::toValues()),
            'created_at' => fake()->dateTimeBetween('-50 days', 'now')
        ];
    }
}
