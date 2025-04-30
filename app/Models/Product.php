<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'owner_id', 'image', 'category_id'
    ];

  
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

   
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * العلاقة مع الـ Media
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function specialOffers()
    {
        return $this->hasMany(SpecialOffer::class);
    }

    
    public function category()
    {
        return $this->belongsTo(Category::class); // العلاقة مع الفئة
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price')->withTimestamps();
    }
}
