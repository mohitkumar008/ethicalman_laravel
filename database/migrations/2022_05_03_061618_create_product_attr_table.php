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
        Schema::create('product_attr', function (Blueprint $table) {
            $table->id();
            $table->integer('pid');
            $table->string('sku');
            $table->string('attr_img');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('size_id');
            $table->integer('color_id');
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
        Schema::dropIfExists('product_attr');
    }
};
