<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);

    }

    public function products()
    {
        return $this->hasMany(Product::class, 'owner_id');
    }

    public function guides()
    {
        return $this->hasMany(Package::class, 'guide_id');
    }

    // دالة مساعدة للحصول على اسم الدور بشكل مقروء
    public function getRoleNameAttribute()
    {
        return match($this->role) {
            'general_admin' => 'General_Admin',
            'general_owner' => 'product_Owner',
            'user' => 'User',
            default => 'User'
        };
    }
}