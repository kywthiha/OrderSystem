<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->unsignedBigInteger('disp_order');
            $table->uuid('pack_id')->primary();
            $table->string('pack_name');
            $table->text('pack_description')->nullable();
            $table->string('pack_type');
            $table->integer('total_credit');
            $table->string('tag_name')->nullable();
            $table->integer('validity_month');
            $table->float('pack_price');
            $table->boolean('newbie_first_attend')->default(true);
            $table->integer('newbie_addition_credit')->default(0);
            $table->text('newbie_note')->nullable();
            $table->string('pack_alias');
            $table->float('estimate_price')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->index('disp_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packs');
    }
}
