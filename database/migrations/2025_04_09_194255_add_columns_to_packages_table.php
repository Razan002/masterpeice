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
        Schema::table('packages', function (Blueprint $table) {
            $table->date('date')->nullable();  // إضافة عمود تاريخ  
            $table->time('start_time')->nullable();  // إضافة عمود وقت بداية الرحلة
            $table->time('end_time')->nullable();    // إضافة عمود وقت نهاية الرحلة
            $table->enum('day_of_week', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->nullable(); // إضافة عمود اليوم
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('date');  // حذف عمود تاريخ  
            $table->dropColumn('start_time');  // حذف عمود وقت بداية الرحلة
            $table->dropColumn('end_time');    // حذف عمود وقت نهاية الرحلة
            $table->dropColumn('day_of_week'); // حذف عمود اليوم
        });
    }
};
