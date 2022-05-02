<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('cid');
            $table->string('name');
            $table->string('slug');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('stock');
            $table->integer('featured');
            $table->string('sku');
            $table->string('image');
            $table->string('image_gallery');
            $table->longText('short_desc');
            $table->longText('desc');
            $table->longText('keywords');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
