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
        Schema::table('users', function (Blueprint $table) {
            // إضافة القيمة 'guide' إلى عمود الـ 'role'
            $table->enum('role', ['user', 'product_owner', 'general_admin', 'guide'])->default('user')->change();
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // الرجوع للقيم القديمة في حالة التراجع
            $table->enum('role', ['user', 'product_owner', 'general_admin'])->default('user')->change();
        });
    }
    
};
