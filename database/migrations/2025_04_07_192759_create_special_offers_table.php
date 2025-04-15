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
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 5, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('package_id')->nullable()->constrained('packages');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_offers');
}
};