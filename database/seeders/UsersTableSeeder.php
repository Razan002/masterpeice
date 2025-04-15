<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345'),
                'phone' => '0791234567',
                'address' => 'Amman, Jordan',
                'role' => 'general_admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345'),
                'phone' => '0781234567',
                'address' => 'Irbid, Jordan',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}