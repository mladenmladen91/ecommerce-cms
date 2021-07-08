<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlexCustomersRabat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flex_customers_rabat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("discount_id");
            $table->foreign("customer_id")->references("id")->on("flex_customers")->onDelete("cascade");
            $table->foreign("product_id")->references("id")->on("flex_product")->onDelete("cascade");
            $table->foreign("discount_id")->references("id")->on("flex_discounts")->onDelete("cascade");
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
        Schema::dropIfExists('flex_customers_rabat');
    }
}
