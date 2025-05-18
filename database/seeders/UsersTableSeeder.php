<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'phone' => '0791234567',
                'role' => 'general_admin',
                'address' => 'Amman, Jordan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
        DB::table('users')->updateOrInsert(
            ['email' => 'user@example.com'],
            [
                'name' => 'General User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'phone' => '0781234567',
                'role' => 'user',
                'address' => 'Irbid, Jordan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
          DB::table('users')->updateOrInsert(
            ['email' => 'product@example.com'],
            [
                'name' => 'product owner',
                'email' => 'product@example.com',
                'password' => bcrypt('password'),
                'phone' => '0791234567',
                'role' => 'product_owner',
                'address' => 'Irbid, Jordan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        
    }
}