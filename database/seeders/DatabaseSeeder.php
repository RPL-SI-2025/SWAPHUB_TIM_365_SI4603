<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
            'phone' => '081234567890',
            'profile_picture' => null,
        ]);

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '081122334455',
            'profile_picture' => null,
        ]);

        $this->call(KategoriSeeder::class);
    }
}