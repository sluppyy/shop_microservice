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
            $table->foreignId('product_id')->constrained('hat_products');
            $table->unsignedInteger('count');
            $table->timestamps();


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