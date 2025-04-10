<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the test user
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jan Mikulka',
            'email' => 'jan.mikulka@email.cz',
            'password' => bcrypt(env('TEST_USER_PASSWORD') ?? Str::uuid()->toString()),
        ]);
    }
}
