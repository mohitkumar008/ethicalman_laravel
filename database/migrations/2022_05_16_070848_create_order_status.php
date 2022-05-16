<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('order_status');
            $table->timestamps();
        });

        DB::table('order_status')->insert([
            ['order_status' => 'Pending'],
            ['order_status' => 'Processing'],
            ['order_status' => 'On Hold'],
            ['order_status' => 'In Delivery'],
            ['order_status' => 'Completed'],
            ['order_status' => 'Cancelled'],
            ['order_status' => 'Refunded'],
            ['order_status' => 'Failed'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
};
