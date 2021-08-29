<?php

namespace App\Exports;

use App\Models\Maker;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */    

    public function collection()
    {
        //
        $query = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*','country.naccs','country.country_en_name as country','country.country_jp_name','foreign_maker.jp_name as maker_name');

        $products = $query->get();

        return $products;
    }

    public function headings() : array
    {
        return ["No", "Product Name Half-Width", "Product Name Full-Width", "Product Name Kana", "Brand Code", "Price Card Product Name1", "Price Card Product Name1", "Full English Name", "English Name", "Image Name", "Jan Code", "Purchasers Product Code", "Unique Wine Code", "Vintage Year", "Amount", "Price Type2", "Type Of Amount", "Bottles Per Case", "Boxes", "Quantity Case", "Quantity Loose", "Recycle Type", "Estimate Finished Price", "Import Base Price Per 1 bottle", "Import Price Per Case", "Internet Case Price", "Shop Price", "RRP", "Case Price", "Bottle Price", "Sales Price Bottle", "Sales Price Case", "Monthly Projected Sales", "Sales Policy Category", "Daily Stock", "Product Main Category", "Product Sub Category", "Primeur Flag", "Standard Classification", "International Code", "Alcohol Tax Code", "tax_sales_type", "tax_import_type", "maker_within_japan_dealer_code", "stock_order_type", "purchasers_code", "chouai_partner_code", "stock_control_code", "stock_control_manager_code", "shop_flag", "hp_flag", "wholesale_flag", "normal_wholesale_flag", "gift_ship_warehouse", "set", "gross_profit_stock_type", "miscellaneous_code", "alcohol_percentage", "nihonshu_index", "amino_acid_index", "color", "color_code", "type_code", "class_code", "class1_code", "size_code", "product_type_ingredients", "product_intro", "product_intro_for_price_card", "paired_food", "paired_cheese", "parker_points_rating", "international_wine_cellar_points", "importer_manager_code", "overseas_order_code", "import_payment_code", "foreign_maker_code", "foreign_maker_grant_code", "price_type3", "local_price_at_origin", "members_price", "local_fees", "foreign_currency_rate", "alcohol_tax_category_code", "tax_category_code", "customs_tax_type_code", "storage_type", "general_storage", "label_type", "cost_of_label", "cases_to_pallete", "meters_cube_category", "meters_cubed", "days_from_jan_1_to_production_date", "bbd", "days_able_to_import_before_bbd", "days_able_to_sell_before_bbd", "first_loss", "first_loss_percent", "second_loss", "second_loss_percent", "final_loss", "final_loss_percent", "vt_manage_flag", "pallete_amount", "inner_amount", "sale_start_day", "drinking_temperature", "dummy", "size_wide", "size_round", "size_tall", "carton_size_wide", "carton_size_depth", "carton_size_height", "development_code", "price_type", "maker_code", "is_reserve", "current_stock", "region", "variety", "rate", "annual_amount", "tree_age", "aging", "soil", "quality_origin", "certification", "description", "updated_at", "cap", "wine_type", "big_image_name", "pdf_image_name", "local_area", "village", "naccs", "country", "country_jp_name", "maker_name"];
    }
}
