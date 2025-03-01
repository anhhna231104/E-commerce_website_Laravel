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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_brand');
            $table->integer('id_category');
            $table->string('image');
            $table->string('name');
            $table->integer('price');
            $table->integer('status');
            $table->integer('sale')->nullable();
            $table->string('detail');
            $table->string('company_profile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
