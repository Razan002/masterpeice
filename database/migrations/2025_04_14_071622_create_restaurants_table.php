<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('restaurants', function (Blueprint $table) {
        $table->id();  // معرف المطعم
        $table->string('name');  // اسم المطعم
        $table->text('description')->nullable();  // وصف للمطعم
        $table->string('address');  // عنوان المطعم
        $table->string('phone')->nullable();  // رقم الهاتف
        $table->string('email')->nullable();  // البريد الإلكتروني
        $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');  // ربط مع الوجهة
        $table->timestamps();  // تاريخ الإنشاء والتعديل
    });
}

public function down(): void
{
    Schema::dropIfExists('restaurants');
}

};
