<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelPromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_promo_codes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('promo_code_id');
            $table->morphs('model');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('promo_code_id')->references('id')->on('promo_codes')->onDelete('no action')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_promo_codes');
    }
}