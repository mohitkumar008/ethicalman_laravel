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
        Schema::create('address_type', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        DB::table('address_type')->insert([
            ['type' => 'Billing Address'],
            ['type' => 'Shipping Address'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_type');
    }
};
