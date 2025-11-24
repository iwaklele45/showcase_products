<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin',
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified' => true,
        ]);

        // Penjual
        User::create([
            'username' => 'seller01',
            'name' => 'Penjual Satu',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'email_verified' => false,
            'store_name' => 'Toko Jawa',
            'store_description' => 'Ini adalah toko menjual peralatan elektronik'
        ]);

        // User Biasa
        User::create([
            'username' => 'user01',
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified' => false
        ]);
    }
}
