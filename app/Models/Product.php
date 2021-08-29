<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'product';

    //
    public function     allProducts($page=25) {
        $query = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
                select('product.*','country.naccs','country.country_en_name as country','country.country_jp_name','foreign_maker.jp_name as maker_name');

//        if($page>0){
//            $query-> offset($start)->limit($page);
//        }

        $products = $query->paginate($page);
        return $products;
    }

    public function detailProducts($id) {

        $query = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*','country.naccs','country.country_en_name as country','country.country_jp_name','foreign_maker.jp_name as maker_name');
        $query->where('product.foreign_maker_code',$id);

//        if($page>0){
//            $query-> offset($start)->limit($page);
//        }

        $products = $query->paginate(25);
        return $products;
    }

    public function adminProducts() {
        $query = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*','country.naccs','country.country_en_name as country','country.country_jp_name','foreign_maker.jp_name as maker_name');

//        if($page>0){
//            $query-> offset($start)->limit($page);
//        }
        return $query;
    }

    public function getProduct($code){
        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        leftJoin('type','product.type_code','=','type.id')->
        leftJoin('product_materials','product.product_code','=','product_materials.product_code')->
        leftJoin('materials','materials.material_code','=','product_materials.material_code')->
        select('product.*','country.country_en_name as country','country.naccs','country.country_jp_name','type.type_name', 'foreign_maker.jp_name as maker_name','foreign_maker.en_name as maker_en_name','foreign_maker.en_name as maker_en_name','foreign_maker.maker_description', DB::raw('group_concat(materials.material_name SEPARATOR ", ") as variety') )->
        where('product.product_code',$code)->
        groupBy('product_materials.product_code')->
        get()->first();
        return $products;
    }



    public function filterProducts($filter,$page=25) {

        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*','country.country_en_name as country','country.naccs', 'foreign_maker.jp_name as maker_name');

        if(isset($filter->count)&&$filter->count) {
            $page = $filter->count;
        }
        if(isset($filter->maker_name)&&$filter->maker_name != '') {
            $products->where(function ($query) use ($filter) {
                $query->orWhere('foreign_maker.jp_name', 'LIKE', '%' . $filter->maker_name . '%');
                $query->orWhere('foreign_maker.jp_full_name', 'LIKE', '%' . $filter->maker_name . '%');
            });
        }
        if(isset($filter->vintageDate)&&$filter->vintageDate != ''){
            $products->where('product.vintage_year', '=', ($filter->vintageDate));
        }

        if(isset($filter->startDate)&&$filter->startDate != ''){
            $products->where('product.vintage_year', '>=', ($filter->startDate));
        }

        if(isset($filter->endDate)&&$filter->endDate != ''){
            $products->where('product.vintage_year', '<=', ($filter->endDate));
        }

        if(isset($filter->availableCheck)&&$filter->availableCheck == 'true') {
            $products->where('product.current_stock', '>', 0);
        }

        if(isset($filter->countryList) && $filter->countoryList !==''){
            $products->where('country.country_en_name',$filter->countryList);
        }

        if(isset($filter->regionList) && $filter->regionList !==''){
            $products->where('product.region',$filter->regionList);
        }

        $total_count = count($products->get());

//        $result = $products->offset($page*$length)->limit($length)->get();
            $result = $products->paginate($page);
        return array('all_products' => $result, 'total_count'=> $total_count, 'countlimit'=>$page);

    }

    public function redVariety($filter){
        $variety = DB::table('color_code')->where('color','1');
        if(isset($filter->redVariety) && $filter->redVariety !='') $variety->where('color_code.variety','LIKE', '%' . $filter->redVariety . '%');
        $result = $variety->get();
        return $result;
    }

    public function availableProducts($page=0, $length=10){
        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*','country.country_en_name as country', 'country.naccs', 'foreign_maker.jp_name as maker_name', 'country.country_jp_name');
        $products->where('product.current_stock', '>', 0);

        $total_count = count($products->get());

        $result = $products->offset($page*$length)->limit($length)->get();

        return $result;
    }
    public function availableProductst($page=0, $length=10){
        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*', 'country.country_en_name as country','country.naccs', 'foreign_maker.jp_name as maker_name', 'country.country_jp_name')->where('product.product_code','>',0)->where('product.product_code','<',20079);
        $products->where('product.current_stock', '>', 0);


        $total_count = count($products->get());

        $result = $products->offset($page*$length)->limit($length)->get();

        return $result;
    }

    public function whiteVariety($filter){
        $variety = DB::table('color_code')->where('color','2');
        if(isset($filter->whiteVariety) && $filter->whiteVariety !='') $variety->where('color_code.variety','LIKE', '%' . $filter->whiteVariety . '%');
        $result = $variety->get();
        return $result;
    }

    public function totalSearch($filter){


        $words =explode('　',$filter->content);
        $search_text = [];
        foreach($words as $word){
            $text = explode(' ',$word);
            foreach($text as $tmp){
                array_push($search_text,$tmp);
            }
        }

        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        leftJoin('type','type.id', '=', 'product.type_code')->
        select('product.*','country.country_en_name as country', 'country.naccs', 'foreign_maker.jp_name as maker_name');

        foreach($search_text as $row){
            if(!isset($row) || $row == '' || $row == ' ') continue;
            if(isset($row) && $row !==''){
                $products->where(function ($query) use ($row) {
                    $query->orWhere('product.full_product_name','LIKE','%'.$row.'%');
                    $query->orWhere('product.product_name','LIKE','%'.$row.'%');
                    $query->orWhere('product.full_english_name','LIKE','%'.$row.'%');
                    $query->orWhere('foreign_maker.jp_name','LIKE','%'.$row.'%');
                    $query->orWhere('foreign_maker.en_name','LIKE','%'.$row.'%');
                    $query->orWhere('foreign_maker.jp_full_name','LIKE','%'.$row.'%');
                    $query->orWhere('product.vintage_year','LIKE','%'.$row.'%');
                    $query->orWhere('product.certification','LIKE','%'.$row.'%');
                    $query->orWhere('product.description','LIKE','%'.$row.'%');
                    $query->orWhere('country.country_jp_name','LIKE','%'.$row.'%');
                    $query->orWhere('country.country_en_name','LIKE','%'.$row.'%');
                    $query->orWhere('product.cap','LIKE','%'.$row.'%');
                    $query->orWhere('type.type_name','LIKE','%'.$row.'%');
                    if($row == '赤') $query->orWhere('product.color',1);
                    if($row == '白') $query->orWhere('product.color',2);
                    if($row == 'ロゼ') $query->orWhere('product.color',3);
                    if($row == 'スパークリング') $query->orWhere('product.color',0);
                    $query->orWhere('product.wine_type','LIKE','%'.$row.'%');
                });
            }
        }

        $result = [];
        $result['search_count'] = count($products->get());
        $result['all_products'] = $products->paginate(25);
        return $result;
    }

    public function advancedSearch($filter){

        $products = DB::table('product')->
        leftJoin('foreign_maker', 'product.foreign_maker_code','=','foreign_maker.foreign_maker_id')->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
        select('product.*', 'country.country_en_name as country','country.naccs', 'foreign_maker.jp_name as maker_name');
        if(isset($filter->product_name) && $filter->product_name !==''){
            $products->where(function ($query) use ($filter) {
                $query->orWhere('product.full_product_name','LIKE','%'.$filter->product_name.'%');
                $query->orWhere('product.product_name','LIKE','%'.$filter->product_name.'%');
                $query->orWhere('foreign_maker.jp_name','LIKE','%'.$filter->product_name.'%');
                $query->orWhere('foreign_maker.jp_full_name','LIKE','%'.$filter->product_name.'%');
            });
        }
        $tmp_filter = [];
        $tmp_filter['start_year'] = $filter->start_year;
        if(isset($filter->start_year) && $filter->start_year !==''){
            $products->where('product.vintage_year','>=',$filter->start_year);
        }

        if(isset($filter->end_year) && $filter->end_year !==''){
            $products->where('product.vintage_year','<=',$filter->end_year);
        }

        $tmp_filter['end_year'] = $filter->end_year;
        if(isset($filter->product_country) && $filter->product_country !==''&&$filter->product_country !=__('wine.Not specified')){
            $products->where('country.country_en_name',$filter->product_country);
        }
        $tmp_filter['product_country'] = $filter->product_country;
        if(isset($filter->product_region) && $filter->product_region !==''&&$filter->product_region !=__('wine.Not specified')){
            $products->where('product.region',$filter->product_region);
        }

        $tmp_filter['product_region'] = $filter->product_region;

        if(isset($filter->start_price) && $filter->start_price !==''&&$filter->start_price !==''){
            $products->where('product.shop_price','>=',$filter->start_price);
        }
        $tmp_filter['start_price'] = $filter->start_price;
        if(isset($filter->end_price) && $filter->end_price !==''&&$filter->end_price !==''){
            $products->where('product.shop_price','<=',$filter->end_price);
        }
        $tmp_filter['end_price'] = $filter->end_price;
        $products->where(function ($query) use ($filter){
            if(isset($filter->red) && $filter->red !==''){
                $query->orWhere('product.color',1);
            }
            if(isset($filter->white) && $filter->white !==''){
                $query->orWhere('product.color',2);
            }
            if(isset($filter->rose) && $filter->rose !==''){
                $query->orWhere('product.color',3);
            }
        });
        $tmp_filter['red'] = $filter->red;
        $tmp_filter['white'] = $filter->white;
        $tmp_filter['rose'] = $filter->rose;

        $tmp_filter['super_dry'] = $filter->super_dry;
        $tmp_filter['spicy'] = $filter->spicy;
        $tmp_filter['medium_dry'] = $filter->medium_dry;
        $tmp_filter['medium_sweet'] = $filter->medium_sweet;
        $tmp_filter['sweet'] = $filter->sweet;
        $tmp_filter['heavy_mouth'] = $filter->heavy_mouth;
        $tmp_filter['medium_weight'] = $filter->medium_weight;
        $tmp_filter['light_mouth'] = $filter->light_mouth;
        $tmp_filter['trocken'] = $filter->trocken;
        $tmp_filter['easy_to_eat'] = $filter->easy_to_eat;
        $tmp_filter['middle'] = $filter->middle;
        $tmp_filter['individual'] = $filter->individual;
        $tmp_filter['fresh'] = $filter->fresh;
        $tmp_filter['cream'] = $filter->cream;
        $tmp_filter['dessert'] = $filter->dessert;
        $tmp_filter['full_body'] = $filter->full_body;
        $tmp_filter['medium_body'] = $filter->medium_body;
        $tmp_filter['light_body'] = $filter->light_body;
        $products->where(function ($query) use ($filter){
            if(isset($filter->super_dry) && $filter->super_dry !==''){
                $query->orWhere('product.type_code',$filter->super_dry);
            }
            if(isset($filter->spicy) && $filter->spicy !==''){
                $query->orWhere('product.type_code',$filter->spicy);
            }
            if(isset($filter->medium_dry) && $filter->medium_dry !==''){
                $query->orWhere('product.type_code',$filter->medium_dry);
            }

            if(isset($filter->medium_sweet) && $filter->medium_sweet !==''){
                $query->orWhere('product.type_code',$filter->medium_sweet);
            }
            if(isset($filter->sweet) && $filter->sweet !==''){
                $query->orWhere('product.type_code',$filter->sweet);
            }
            if(isset($filter->very_sweet) && $filter->very_sweet !==''){
                $query->orWhere('product.type_code',$filter->very_sweet);
            }

            if(isset($filter->heavy_mouth) && $filter->heavy_mouth !==''){
                $query->orWhere('product.type_code',$filter->heavy_mouth);
            }
            if(isset($filter->medium_weight) && $filter->medium_weight !==''){
                $query->orWhere('product.type_code',$filter->medium_weight);
            }
            if(isset($filter->light_mouth) && $filter->light_mouth !==''){
                $query->orWhere('product.type_code',$filter->light_mouth);
            }

            if(isset($filter->trocken) && $filter->trocken !==''){
                $query->orWhere('product.type_code',$filter->trocken);
            }
            if(isset($filter->easy_to_eat) && $filter->easy_to_eat !==''){
                $query->orWhere('product.type_code',$filter->easy_to_eat);
            }
            if(isset($filter->middle) && $filter->middle !==''){
                $query->orWhere('product.type_code',$filter->middle);
            }

            if(isset($filter->individual) && $filter->individual !==''){
                $query->orWhere('product.type_code',$filter->individual);
            }
            if(isset($filter->fresh) && $filter->fresh !==''){
                $query->orWhere('product.type_code',$filter->fresh);
            }
            if(isset($filter->cream) && $filter->cream !==''){
                $query->orWhere('product.type_code',$filter->cream);
            }
            if(isset($filter->dessert) && $filter->dessert !==''){
                $query->orWhere('product.type_code',$filter->dessert);
            }
            if(isset($filter->full_body) && $filter->full_body !==''){
                $query->orWhere('product.type_code',$filter->full_body);
            }
            if(isset($filter->medium_body) && $filter->medium_body !==''){
                $query->orWhere('product.type_code',$filter->medium_body);
            }
            if(isset($filter->light_body) && $filter->light_body !==''){
                $query->orWhere('product.type_code',$filter->light_body);
            }
        });
        for ($i = 0; $i < $filter->red_count; $i++) {
            $str = 'red_variety'.$i;
            if(isset($filter->$str) && $filter->$str !=='') {
                $tmp_filter[$str] = $filter->$str;
            }
        }
        for ($i = 0; $i < $filter->white_count; $i++) {
            $str = 'white_variety'.$i;
            if(isset($filter->$str) && $filter->$str !==''){
                $tmp_filter[$str] = $filter->$str;
            }
        }
        $products->where(function ($query) use ($filter) {
            for ($i = 0; $i < $filter->red_count; $i++) {
                $str = 'red_variety'.$i;
                if(isset($filter->$str) && $filter->$str !==''){
                    $query->orWhere('product.variety',$filter->$str);
                }
            }
            for ($i = 0; $i < $filter->white_count; $i++) {
                $str = 'white_variety'.$i;
                if(isset($filter->$str) && $filter->$str !==''){
                    $query->orWhere('product.variety',$filter->$str);
                }
            }
        });

        $country_tmp = DB::table('country')->get();
        $products->where(function ($query) use ($filter,$country_tmp) {
            foreach($country_tmp as $row){
                $str = $row->country_en_name;
                if(isset($filter->$str) && $filter->$str !==''){
                    $query->orWhere('country.country_en_name',$filter->$str);
                }
            }

        });
        foreach($country_tmp as $row){
            $str = $row->country_en_name;
            if(isset($filter->$str) && $filter->$str !==''){
                $tmp_filter[$str] = $filter->$str;
            }
        }
        $products->where(function ($query) use ($filter) {
                if(isset($filter->still) && $filter->still !==''){
                    $query->orWhere('product.wine_type','スティル');
                }
        });
        $tmp_filter['still'] = $filter->still;
        $products->where(function ($query) use ($filter) {
            if(isset($filter->sparkling) && $filter->sparkling !==''){
                $query->orWhere('product.wine_type','スパークリング');
            }
        });
        $tmp_filter['sparkling'] = $filter->sparkling;
        if(isset($filter->range_price_start) && $filter->range_price_start !==''){
            $products->where('product.shop_price','>=',$filter->range_price_start*1000);
        }
        $tmp_filter['range_price_start'] = $filter->range_price_start;
        if(isset($filter->range_price_end) && $filter->range_price_end !==''){
            $products->where('product.shop_price','<=',$filter->range_price_end*1000);
        }
        $tmp_filter['range_price_end'] = $filter->range_price_end;
        if(isset($filter->annual_amount) && $filter->annual_amount !==''){
            $products->where('product.annual_amount','>=',$filter->annual_amount);
        }
        $tmp_filter['annual_amount'] = $filter->annual_amount;

        if(isset($filter->tree_age) && $filter->tree_age !==''){
            $products->where('product.tree_age','>=',$filter->tree_age);
        }
        $tmp_filter['tree_age'] = $filter->tree_age;
        if(isset($filter->aging) && $filter->aging !==''){
            $products->where('product.aging','>=',$filter->aging);
        }
        $tmp_filter['aging'] = $filter->aging;
        if(isset($filter->soil) && $filter->soil !=''){
            $products->where('product.soil','LIKE', '%' . $filter->soil . '%');
        }
        $tmp_filter['soil'] = $filter->soil;

        $quality_tmp = DB::table('quality_origin')->get();
        $products->where(function ($query) use ($filter,$quality_tmp) {

            foreach($quality_tmp as $row){
                $str = $row->id;
                $ans = $row->quality_name;
                if(isset($filter->$str) && $filter->$str !==''){
                    $query->orWhere('product.quality_origin',$ans);
                }
            }
        });



        foreach($quality_tmp as $row){
            $str = $row->id;
            $ans = $row->quality_name;
            if(isset($filter->$str) && $filter->$str !==''){
                $tmp_filter[$str] = $filter->$str;
            }
        }

        $certification_tmp = DB::table('certification')->get();
        $products->where(function ($query) use ($filter,$certification_tmp) {

            foreach($certification_tmp as $row){
                $str = 'certification'.$row->id;

                $ans = $row->certification_name;

                if(isset($filter->$str) && $filter->$str !==''){
                    $query->orWhere('product.certification',$ans);
                }
            }
        });

        foreach($certification_tmp as $row){
            $str = 'certification'.$row->id;

            $ans = $row->certification_name;

            if(isset($filter->$str) && $filter->$str !==''){
                $tmp_filter[$str] = $filter->$str;
            }
        }

        $result = [];
        $result['search_count'] = count($products->get());
        $result['all_products'] = $products->paginate(25);
        $result['filter'] = $tmp_filter;
        return $result;
    }

    public static function ajaxProductList($filter){


        $data = [];
        $query = DB::table('product')->select('product.*','country.country_en_name as country', 'foreign_maker.jp_name as maker_jp_name', 'foreign_maker.en_name as maker_en_name', 'type.type_name');

        $query->leftjoin('foreign_maker', function($join){
            $join->on('foreign_maker.foreign_maker_id', '=', 'product.foreign_maker_code');
        })->leftjoin('type', function($join){
            $join->on('product.type_code', '=', 'type.id');
        })->leftjoin('country', function($join){
            $join->on('foreign_maker.maker_country', '=', 'country.country_en_name');
        });

        $totals = count($query->get());

        $total_filtered = $totals;

        if(isset($filter["searchtype"])){

            $filter_res = $query->where('product.color',$filter["searchtype"] )->get();

            $total_filtered = count($filter_res);
        }


        if(isset($filter["searchcountry"])){
            $filter_res = $query->where('country.country_en_name', $filter["searchcountry"])->get();

            $total_filtered = count($filter_res);
        }

        if(isset($filter['searchmaker'])){
            $filter_res = $query->where('product.foreign_maker_code', $filter["searchmaker"])->get();

            $total_filtered = count($filter_res);
        }

        if(isset($filter["searchcolor"])){
            if($filter["searchcolor"] == 4)
                $filter_res = $query->where('product.color', 0)->get();
            else $filter_res = $query->where('product.color', $filter["searchcolor"])->get();

            $total_filtered = count($filter_res);
        }

        if(isset($filter["searchyear"])){
            $filter_res = $query->where('product.vintage_year', $filter["searchyear"])->get();;

            $total_filtered = count($filter_res);
        }

        if(isset($filter["searchtaste"])){
            $filter_res = $query->where('type.id', $filter["searchtaste"])->get();

            $total_filtered = count($filter_res);
        }

        if(isset($filter["search"]["value"])){
            $search_val = $filter["search"]["value"];

            $filter_res = $query->where(function($q) use($search_val) {


                          })->get();

            $total_filtered = count($filter_res);
        }

            if(isset($filter['order'][0]["column"]) && $filter['order'][0]["column"]>0){
            switch ($filter['order'][0]["column"]) {
                case 1:
                    $order_field = "product.color";
                    break;
                case 2:
                    $order_field = "product.full_product_name";
                    break;
                case 3:
                    $order_field = "product.year";
                    break;
                case 4:
                    $order_field = "foreign_maker.jp_name";
                case 5:
                    $order_field = "product.rate";
                case 6:
                    $order_field = "product.bottles_per_case";
                case 7:
                    $order_field = "product.shop_price";
                default:
                    $order_field = "product.rate";
            }

            $order_asc = "asc";
            if(isset($filter['order'][0]["dir"] )){
                $order_asc = $filter['order'][0]["dir"];
            }

            $query->orderBy($order_field, $order_asc);
        }

        if( isset($filter['length'])&&$filter['length'] >= 0 ){
            $data = $query->offset($filter['start'])->limit($filter['length'])->get();

        }else{
            $data = $query->get();
        }

        $result = array('data' => $data, 'recordsFiltered'=> $total_filtered, 'recordsTotal'=>$totals, 'draw'=>$filter['draw']);

        return $result;
    }


}
