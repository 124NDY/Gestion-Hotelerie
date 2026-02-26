<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Réceptionniste',
            'email' => 'recep@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'receptionniste',
        ]);

        User::create([
            'name' => 'Client Test',
            'email' => 'client@hotel.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);
    }
}