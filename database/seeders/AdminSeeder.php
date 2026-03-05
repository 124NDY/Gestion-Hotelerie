<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom'       => 'Administrateur',
            'email'     => 'admin@hotel.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'photo_url' => 'default_user.jpg',
        ]);
    }
}