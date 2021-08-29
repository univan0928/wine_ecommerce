<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductMaker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_maker', function (Blueprint $table) {
            $table->integer('product_code');
            $table->primary('product_code');
            $table->integer('average_age_from');
            $table->integer('average_age_to');
            $table->string('pruning',100);
            $table->string('density',50);
            $table->string('fertilization',50);
            $table->string('green_harvest',50);
            $table->string('harvesting_method',50);
            $table->string('period_of_harvest',50);
            $table->decimal('planted_area',20,6);
            $table->string('soil',50);
            $table->decimal('amount_per_hectare',20,6);
            $table->integer('fermentation_degrees_from');
            $table->integer('fermentation_degrees_to');
            $table->integer('fermentation_days_from');
            $table->integer('fermentation_days_to');
            $table->string('first_fermentation_tank',50);
            $table->string('second_fermentation_new',50);
            $table->string('marolactic_fermenting',50);
            $table->string('filtering',50);
            $table->string('clarification_process',50);
            $table->string('barrels_original_country_of_production',50);
            $table->string('main_barrel_production_company_name',50);
            $table->string('pulling',50);
            $table->integer('barrel_aging_period_from');
            $table->integer('barrel_aging_period_to');
            $table->integer('bottle_aging_period_from');
            $table->integer('bottle_aging_period_to');
            $table->string('number_of_bottles_made',50);
            $table->string('drinking_style',50);
            $table->string('message_from_maker',4000);
            $table->string('picture_of_field',50);
            $table->string('picture_of_master_winemaker',50);
            $table->string('address',50);
            $table->string('tel',50);
            $table->string('country',50);
            $table->string('region',50);
            $table->string('old_world_new_world',50);
            $table->string('brandsheld',50);
            $table->string('description',50);
            $table->string('map',50);
            $table->string('no_of_wines_made',50);
            $table->string('association',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_maker');
    }
}
