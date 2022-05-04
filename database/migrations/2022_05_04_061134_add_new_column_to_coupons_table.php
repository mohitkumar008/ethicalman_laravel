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
        Schema::table('coupons', function (Blueprint $table) {
            $table->enum('type', ['Value', 'Per'])->after('value');
            $table->integer('min_order_amount')->after('type');
            $table->integer('is_one_time')->after('min_order_amount');
            $table->integer('status')->after('is_one_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['type', 'min_order_amount', 'is_one_time', 'status']);
        });
    }
};
