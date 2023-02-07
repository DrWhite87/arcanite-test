<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '79284525721',
        ]);

        User::factory(10)->create();
    }
}
