<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // تأكد من وجود بيانات أولية
        $users = User::all();
        $packages = Package::all();
        $destinations = Destination::all();

        if ($users->isEmpty() || ($packages->isEmpty() && $destinations->isEmpty())) {
            $this->command->error('يجب وجود مستخدمين و باقات/وجهات أولاً!');
            return;
        }

        // بيانات الحجوزات
        $bookings = [
            [
                'user_id' => $users->random()->id,
                'package_id' => $packages->isNotEmpty() ? $packages->random()->id : null,
                'destination_id' => $destinations->isNotEmpty() ? $destinations->random()->id : null,
                'booking_date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'payment_method' => ['online', 'on_spot'][rand(0, 1)],
                'total_price' => rand(50, 500),
                'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)]
            ],
            // المزيد من الحجوزات...
        ];

        // إضافة 10 حجوزات عشوائية
        for ($i = 0; $i < 10; $i++) {
            Booking::create([
                'user_id' => $users->random()->id,
                'package_id' => $packages->isNotEmpty() ? $packages->random()->id : null,
                'destination_id' => $destinations->isNotEmpty() ? $destinations->random()->id : null,
                'booking_date' => Carbon::now()->addDays(rand(1, 365))->format('Y-m-d'),
                'payment_method' => ['online', 'on_spot'][rand(0, 1)],
                'total_price' => rand(20, 1000),
                'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
                'created_at' => Carbon::now()->subDays(rand(0, 60))
            ]);
        }

        $this->command->info('تم إنشاء 10 حجوزات تجريبية بنجاح!');
    }
}