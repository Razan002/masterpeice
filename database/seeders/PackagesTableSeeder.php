<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackagesTableSeeder extends Seeder
{
    public function run()
    {
        // إدخال الحزم الخاصة بالسلط
        DB::table('packages')->insert([
            [
                'title' => 'Adventure Package - وسط البلد',
                'description' => 'A thrilling adventure across Al-Salt, explore the historical downtown areas of Al-Salt.',
                'max_people' => 4,
                'meal' => 'Lunch and Dinner',
                'has_hotel' =>0,
                'type' => 'adventure',
                'guide_id' => 1,
                'destination_id' => 7,  // فرضًا أن وسط البلد-السلط في الـ destination_id 1
                'price' => 50.00,
                'date' => Carbon::now()->toDateString(),
                'has_museum' => true,  // يوجد متحف في وسط البلد
                'museum_name' => 'Al-Salt Museum', // اسم المتحف في وسط البلد
            ],
          
        ]);
    }
}
