<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'package_id', 'product_id', 'guide_id', 'rating', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public static function canReview($userId, $destinationId)
    {
        return Booking::where('user_id', $userId)
                    ->where('destination_id', $destinationId)
                    ->where('status', 'confirmed')
                    ->exists();
    }

    public static function getUserBooking($userId, $destinationId)
    {
        return Booking::where('user_id', $userId)
                    ->where('destination_id', $destinationId)
                    ->where('status', 'confirmed')
                    ->first();
    }
}
