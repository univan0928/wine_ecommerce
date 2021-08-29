<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('product_code');
            $table->primary('product_code');
            $table->integer('current_stock')->nullable;
            $table->tinyInteger('is_reserve')->nullable;
            $table->string('full_product_name',100)->nullable();
            $table->string('product_name',26)->nullable();
            $table->string('product_name_kana',20)->nullable();
            $table->integer('brand_code')->nullable();
            $table->string('price_card_product_name1',36)->nullable();
            $table->string('price_card_product_name2',36)->nullable();
            $table->string('full_english_name',80)->nullable();
            $table->string('english_name',40)->nullable();
            $table->string('image_name',50)->nullable();
            $table->string('region',50)->nullable();
            $table->string('country',50)->nullable();
            $table->smallInteger('tree_age')->nullable();
            $table->integer('annual_amount')->nullable();
            $table->string('soil',255)->nullable();
            $table->smallInteger('aging')->nullable();


            $table->tinyInteger('rate')->nullable();
            $table->string('jan_code',14)->nullable();
            $table->string('purchasers_product_code',14)->nullable();
            $table->string('unique_wine_code',27)->nullable();
            $table->year('vintage_year')->nullable();
            $table->decimal('amount',3,3)->nullable();
            $table->tinyInteger('price_type2')->nullable();
            $table->tinyInteger('type_of_amount')->nullable();
            $table->tinyInteger('bottles_per_case')->nullable();
            $table->tinyInteger('boxes')->nullable();
            $table->decimal('quantity_case',3,1)->nullable();
            $table->tinyInteger('quantity_loose')->nullable();
            $table->tinyInteger('recycle_type')->nullable();
            $table->decimal('estimate_finished_price',6,2)->nullable();
            $table->decimal('import_base_price_per_1_bottle',5,2)->nullable();
            $table->decimal('import_price_per_case',5,2)->nullable();
            $table->decimal('internet_case_price',6,2)->nullable();
            $table->decimal('shop_price',7,2)->nullable();
            $table->decimal('RRP',6,2)->nullable();
            $table->decimal('case_price',6,2)->nullable();
            $table->decimal('bottle_price',6,2)->nullable();
            $table->decimal('sales_price_bottle',5,2)->nullable();
            $table->decimal('sales_price_case',5,2)->nullable();
            $table->decimal('monthly_projected_sales',6,2)->nullable();
            $table->tinyInteger('sales_policy_category')->nullable();

            $table->tinyInteger('daily_stock')->nullable();
            $table->tinyInteger('product_main_category')->nullable();
            $table->tinyInteger('product_sub_category')->nullable();
            $table->tinyInteger('primeur_flag')->nullable();
            $table->tinyInteger('standard_classification')->nullable();
            $table->tinyInteger('international_code')->nullable();
            $table->tinyInteger('alcohol_tax_code')->nullable();
            $table->tinyInteger('tax_sales_type')->nullable();
            $table->tinyInteger('tax_import_type')->nullable();
            $table->tinyInteger('maker_within_japan_dealer_code')->nullable();
            $table->tinyInteger('stock_order_type')->nullable();
            $table->tinyInteger('purchasers_code')->nullable();

            $table->tinyInteger('chouai_partner_code')->nullable();
            $table->tinyInteger('stock_control_code')->nullable();
            $table->tinyInteger('stock_control_manager_code')->nullable();
            $table->tinyInteger('shop_flag')->nullable();
            $table->tinyInteger('hp_flag')->nullable();
            $table->tinyInteger('wholesale_flag')->nullable();
            $table->tinyInteger('normal_wholesale_flag')->nullable();
            $table->tinyInteger('gift_ship_warehouse')->nullable();
            $table->tinyInteger('set')->nullable();
            $table->tinyInteger('gross_profit_stock_type')->nullable();
            $table->tinyInteger('miscellaneous_code')->nullable();

            $table->decimal('alcohol_percentage',2,1)->nullable();
            $table->decimal('nihonshu_index',2,1)->nullable();
            $table->decimal('amino_acid_index',2,1)->nullable();
            $table->tinyInteger('color')->nullable();
            $table->tinyInteger('color_code')->nullable();
            $table->tinyInteger('type_code')->nullable();
            $table->tinyInteger('class_code')->nullable();
            $table->tinyInteger('class1_code')->nullable();
            $table->tinyInteger('size_code')->nullable();
            $table->string('product_type_ingredients',80)->nullable();
            $table->string('product_intro',255)->nullable();
            $table->string('product_intro_for_price_card',70)->nullable();
            $table->smallInteger('paired_food')->nullable();
            $table->smallInteger('paired_cheese')->nullable();
            $table->tinyInteger('parker_points_rating')->nullable();
            $table->tinyInteger('international_wine_cellar_points')->nullable();
            $table->tinyInteger('importer_manager_code')->nullable();
            $table->tinyInteger('overseas_order_code')->nullable();
            $table->smallInteger('import_payment_code')->nullable();
            $table->smallInteger('foreign_maker_code')->nullable();
            $table->tinyInteger('foreign_maker_grant_code')->nullable();
            $table->tinyInteger('price_type3')->nullable();
            $table->decimal('local_price_at_origin',7,2)->nullable();
            $table->decimal('members_price',7,2)->nullable();
            $table->decimal('local_fees',3,2)->nullable();
            $table->tinyInteger('foreign_currency_rate')->nullable();
            $table->tinyInteger('alcohol_tax_category_code')->nullable();
            $table->string('tax_category_code',10)->nullable();
            $table->tinyInteger('customs_tax_type_code')->nullable();
            $table->tinyInteger('storage_type')->nullable();
            $table->string('general_storage',1)->nullable();
            $table->tinyInteger('label_type')->nullable();
            $table->decimal('cost_of_label',7,2)->nullable();
            $table->tinyInteger('cases_to_pallete')->nullable();
            $table->tinyInteger('meters_cube_category')->nullable();
            $table->decimal('meters_cubed',7,2)->nullable();
            $table->tinyInteger('days_from_jan_1_to_production_date')->nullable();
            $table->tinyInteger('bbd')->nullable();
            $table->tinyInteger('days_able_to_import_before_bbd')->nullable();
            $table->tinyInteger('days_able_to_sell_before_bbd')->nullable();
            $table->tinyInteger('first_loss')->nullable();
            $table->tinyInteger('first_loss_percent')->nullable();
            $table->tinyInteger('second_loss')->nullable();
            $table->tinyInteger('second_loss_percent')->nullable();
            $table->tinyInteger('final_loss')->nullable();
            $table->tinyInteger('final_loss_percent')->nullable();
            $table->tinyInteger('vt_manage_flag')->nullable();
            $table->tinyInteger('pallete_amount')->nullable();
            $table->tinyInteger('inner_amount')->nullable();
            $table->date('sale_start_day')->nullable();
            $table->string('drinking_temperature',20)->nullable();
            $table->string('dummy',10)->nullable();
            $table->decimal('size_wide',6,2)->nullable();
            $table->decimal('size_round',6,2)->nullable();
            $table->decimal('size_tall',6,2)->nullable();
            $table->decimal('carton_size_wide',6,2)->nullable();
            $table->decimal('carton_size_depth',6,2)->nullable();
            $table->decimal('carton_size_height',6,2)->nullable();
            $table->tinyInteger('development_code')->nullable();
            $table->tinyInteger('price_type')->nullable();
            $table->smallInteger('maker_code')->nullable();
            $table->string('variety')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
