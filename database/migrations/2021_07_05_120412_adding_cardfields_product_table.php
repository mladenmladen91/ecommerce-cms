<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingCardfieldsProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flex_product', function (Blueprint $table) {
            $table->float("telecom_12", 10, 2)->nullable();
            $table->float("telecom_24", 10, 2)->nullable();
            $table->float("card_12", 10, 2)->nullable();
            $table->float("card_24", 10, 2)->nullable();
            $table->float("card_48", 10, 2)->nullable();
            $table->integer("new_order")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flex_product', function (Blueprint $table) {
            //
        });
    }
}
