<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('media')->insert([
            [
                'package_id' => 12,  // فرضًا أن الحزمة مع رقم ID 1
                'product_id' => null,  // لا يوجد منتج مرتبط في هذا المثال
                'media' => 'adventure-package-1.jpg',  // اسم الصورة
            ],
           
        ]);
    }
}
