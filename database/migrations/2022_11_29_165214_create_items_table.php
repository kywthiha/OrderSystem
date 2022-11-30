<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('created_user');
            $table->unsignedBigInteger('updated_user')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('restrict');
            $table->foreign('created_user')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_user')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('items');
    }
}
