<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image'
    ];

    public function packages()
    {
        return $this->hasMany(Package::class, 'destination_id');
    }
    public function specialOffers()
{
    return $this->hasMany(SpecialOffer::class);
}
}
