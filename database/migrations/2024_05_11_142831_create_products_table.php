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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('description');
      $table->longText('content');
      $table->foreignId('producttype_id')->references('id')->on('product_types');
      $table->foreignId('trademark_id')->references('id')->on('trademarks');
      $table->foreignId('promotion_id')->references('id')->on('promotions');
      $table->string('thumb');
      $table->integer('quantity');
      $table->integer('price');
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
