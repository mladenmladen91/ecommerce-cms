<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlexOrdersUpdateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flex_orders', function (Blueprint $table) {
            $table->string("company_name")->nullable();
            $table->string("pib")->nullable();
            $table->string("pdv")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flex_orders', function (Blueprint $table) {
            //
        });
    }
}
