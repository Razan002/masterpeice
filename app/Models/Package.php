<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'max_people',
        'meal',
        'has_hotel',
        'type',
        'guide_id',
        'destination_id',
        'has_museum',
        'museum_name',
        'price',
        'date',
        'start_time',
        'end_time',
        'day_of_week'
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function specialOffers()
    {
        return $this->hasMany(SpecialOffer::class);
    }
    

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

}
