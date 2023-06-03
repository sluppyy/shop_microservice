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
        Schema::create('hat_user_items', function (Blueprint $table) {
            $table->string('user_id');
            $table->bigInteger('product_id');
            $table->unsignedInteger('count');

            $table->foreign('product_id')->references('id')->on('hat_products');

            $table->primary(array('user_id', 'product_id'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hat_user_items');
    }
};