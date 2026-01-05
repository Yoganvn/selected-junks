<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@junks.com',
            'password' => Hash::make('password'), // Passwordnya 'password'
            'role' => 'admin', // <--- INI KUNCINYA
        ]);
    }
}