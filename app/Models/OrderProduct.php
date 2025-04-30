<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    // إذا كان اسم الجدول غير عادي، يمكنك تحديده هنا
    protected $table = 'order_product';

    // تعيين الأعمدة التي يمكن التعديل عليها
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // إذا أردت أن تحتوي العلاقة على الوقت (created_at, updated_at)
    public $timestamps = true;

    // إذا كنت تحتاج إلى إضافة علاقات مع الجداول الأخرى (مثل المنتجات أو الطلبات)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
