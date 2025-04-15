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
    Schema::create('guide_destination', function (Blueprint $table) {
        $table->id();
        // ربط مع جدول المستخدمين
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // دليل اليوزر
        // ربط مع جدول الوجهات
        $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');  // وجهة
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('guide_destination');
}

};
