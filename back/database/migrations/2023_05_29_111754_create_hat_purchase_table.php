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
        Schema::create('hat_purchases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained('hat_products');
            $table->string('user_id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('count');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hat_purchase');
    }
};