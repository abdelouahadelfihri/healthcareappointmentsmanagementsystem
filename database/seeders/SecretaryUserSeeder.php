<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SecretaryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'abdelouahadelfihri107@gmail.com'],
            [
                'name' => 'Secretary',
                'password' => Hash::make('password123'),
                'role' => 'secretary',
                'email_verified_at' => now(),
            ]
        );
    }
}
