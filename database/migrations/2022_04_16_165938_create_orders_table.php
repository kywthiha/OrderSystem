<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('sub_total');
            $table->float('gst');
            $table->float('discount');
            $table->float('grand_total');
            $table->string('promo_code_code')->nullable();
            $table->text('promo_code_description')->nullable();
            $table->float('promo_code_discount')->nullable();
            $table->unsignedBigInteger('promo_code_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('promo_code_id')->references('id')->on('promo_codes')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
