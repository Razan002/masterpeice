<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('destinations')->insert([
            [
                'name' => 'Salt Archaeological Museum',
                'description' => 'One of Jordan\'s oldest museums displaying artifacts from Bronze and Roman ages.',
                'location' => 'Downtown Salt',
                'price' => 2.00,
                'image' => 'museum_salt.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Old Salt Souq',
                'description' => 'Traditional market selling local products like textiles and sweets.',
                'location' => 'City Center',
                'price' => 0.00,
                'image' => 'old_souq.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Abu Jaber House',
                'description' => 'Historic mansion from the late 19th century with beautiful frescoes.',
                'location' => 'Al Ain Street',
                'price' => 2.50,
                'image' => 'abu_jaber.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Hammam Street',
                'description' => 'Charming historic street with traditional buildings.',
                'location' => 'Hammam Street',
                'price' => 0.00,
                'image' => 'hammam_street.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Salt Folklore Museum',
                'description' => 'Museum displaying traditional Jordanian clothing and tools.',
                'location' => 'Cultural District',
                'price' => 1.50,
                'image' => 'folklore_museum.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}