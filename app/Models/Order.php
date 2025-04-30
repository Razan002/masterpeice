<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // تحديد اسم الجدول إذا كان مختلفاً عن الاسم الافتراضي
    protected $table = 'orders';  // تأكد من أن اسم الجدول يتطابق مع الجدول في قاعدة البيانات

    // تحديد الأعمدة القابلة للتحديث (المعروفة بالـ fillable)
    protected $fillable = ['user_id', 'total', 'status', 'address', 'payment_method'];

    // العلاقة بين الطلب والمستخدم
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // ربط الطلب بالمستخدم
    }

    // العلاقة بين الطلب والمنتجات (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price')->withTimestamps();
    }
}
