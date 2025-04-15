<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Adding categories in English
        Category::create([
            'name' => 'Handicrafts & Heritage',
            'description' => 'Handmade products reflecting local heritage.',
        ]);

        Category::create([
            'name' => 'Jewelry',
            'description' => 'A collection of exquisite and modern jewelry.',
        ]);

        Category::create([
            'name' => 'Local Food Products',
            'description' => 'Fresh, locally sourced food products.',
        ]);

        Category::create([
            'name' => 'Natural Products',
            'description' => 'Natural and healthy products from local materials.',
        ]);

        Category::create([
            'name' => 'Home Essentials',
            'description' => 'Home products to improve daily living.',
        ]);
    }
}
