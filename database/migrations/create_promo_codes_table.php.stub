<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->decimal('pct_discount')->nullable();
            $table->decimal('amount_discount')->nullable();
            $table->decimal('pct_shipping_discount')->nullable();
            $table->integer('max_uses')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('first_order_only')->nullable();
            $table->boolean('one_use_only')->nullable();
            $table->boolean('customer_one_use_only')->nullable();
            $table->boolean('active')->default(true);
            $table->string('code')->unique();
            $table->text('action')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}