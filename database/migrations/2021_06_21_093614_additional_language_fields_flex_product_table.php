<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionalLanguageFieldsFlexProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flex_product', function (Blueprint $table) {
            $table->string('name_ru')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('specification_en')->nullable();
            $table->text('specification_ru')->nullable();
            $table->text('specification_title_en')->nullable();
            $table->text('specification_title_ru')->nullable();
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
