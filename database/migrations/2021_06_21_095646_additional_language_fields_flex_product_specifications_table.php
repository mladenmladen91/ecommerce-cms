<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalLanguageFieldsFlexProductSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flex_product_specifications', function (Blueprint $table) {
            $table->string('label_en')->nullable();
            $table->text('value_en')->nullable();
            $table->string('label_ru')->nullable();
            $table->text('value_ru')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flex_product_specifications', function (Blueprint $table) {
            //
        });
    }
}
