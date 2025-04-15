<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // إنشاء جدول categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // عمود الـ ID
            $table->string('name');  // عمود اسم الفئة
            $table->text('description')->nullable();  // عمود الوصف الفئة
            $table->timestamps();  // عمودان للتاريخ والوقت (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // حذف جدول categories إذا تم التراجع عن الـ migration
        Schema::dropIfExists('categories');
    }
}
