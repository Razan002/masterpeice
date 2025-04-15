<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    // إضافة العمود image و category_id إلى الـ fillable
    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'owner_id', 'image', 'category_id'
    ];

    /**
     * العلاقة مع الـ User (المالك)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * العلاقة مع الـ Reviews
     */
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

    /**
     * العلاقة مع الـ Special Offers
     */
    public function specialOffers()
    {
        return $this->hasMany(SpecialOffer::class);
    }

    /**
     * العلاقة مع الـ Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // العلاقة مع الفئة
    }
}
