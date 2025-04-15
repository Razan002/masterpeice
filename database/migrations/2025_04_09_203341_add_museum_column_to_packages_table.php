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
        Schema::table('packages', function (Blueprint $table) {
            $table->boolean('has_museum')->default(false);  // إضافة عمود للتحقق إذا كان هناك متحف
            $table->string('museum_name')->nullable();  // إضافة عمود يحتوي على اسم المتحف إذا كان موجودًا
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('has_museum');  // حذف عمود وجود المتحف
            $table->dropColumn('museum_name'); // حذف عمود اسم المتحف
        });
    }
};
