<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Country extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('country_jp_name',100)->nullable();
            $table->string('naccs',10)->nullable();
            $table->string('country_en_name')->nullable();
            $table->json('regions')->nullable();
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
