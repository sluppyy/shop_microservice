<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hat_products', function (Blueprint $table) {
            $table->unsignedInteger('custom_model_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hat_products', function (Blueprint $table) {
            $table->dropColumn('custom_model_data');
        });
    }
};