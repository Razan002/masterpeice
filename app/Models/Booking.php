<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'package_id', 'destination_id', 'booking_date', 'payment_method', 'total_price', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // إضافة العلاقة بين الحجز والمراجعات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
