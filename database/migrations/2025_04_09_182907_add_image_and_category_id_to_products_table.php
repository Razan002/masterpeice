<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable();  // إضافة عمود الصورة
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');  // إضافة العلاقة مع جدول categories
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');  // حذف عمود الصورة
            $table->dropForeign(['category_id']);  // حذف العلاقة مع جدول categories
            $table->dropColumn('category_id');  // حذف عمود category_id
        });
    }
};
