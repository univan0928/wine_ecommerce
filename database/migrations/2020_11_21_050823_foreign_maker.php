<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignMaker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_maker', function (Blueprint $table) {
            $table->id('foreign_maker_id');
            $table->string('en_name',100)->nullable();
            $table->string('jp_name',100)->nullable();
            $table->string('country')->nullable();
            $table->string('area',100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
