<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->foreignId('destination_id')->nullable()->constrained();
        $table->foreignId('booking_id')->nullable()->constrained();
    });
}

public function down()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropForeign(['destination_id']);
        $table->dropForeign(['booking_id']);
        $table->dropColumn(['destination_id', 'booking_id']);
    });
}
};
