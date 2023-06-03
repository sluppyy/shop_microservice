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
            $table->bigInteger('product_id');
            $table->string('user_id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('count');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('hat_products');
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