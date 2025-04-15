<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('location')->after('description')->nullable();
            $table->decimal('price', 8, 2)->after('location')->default(0);
        });
    }

    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn(['location', 'price']);
        });
    }
};