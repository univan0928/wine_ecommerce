<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Maker extends Model
{
    protected $table = 'foreign_maker';

    protected $fillable = ['foreign_maker_id'];

    public function getAll($page=1){
        $maker = DB::table('foreign_maker')->get();
        return $maker;
    }
    public function getAdminAll($page=1){
        $maker = DB::table('foreign_maker')->orderby('jp_name', 'asc');
        return $maker;
    }
    public function getMaker($code){
        $maker = DB::table('foreign_maker')->where('foreign_maker_id',$code)->
        leftJoin('country','foreign_maker.maker_country','=','country.country_en_name')->
            select('foreign_maker.*','country.naccs','country.country_jp_name')->
            get()->first();
        return $maker;

    }


    public static function getDataFilter($filter)
    {
        $data = [];
        $query = DB::table('foreign_maker');


        $totals = count($query->get());

        $total_filtered = $totals;

        if ($filter["search"]["value"]) {
            $search_val = $filter["search"]["value"];

            $filter_res = $query->where(function ($q) use ($search_val) {
                $q->Where("foreign_maker.en_name", "like", "%" . $search_val . "%")
                    ->orWhere("foreign_maker.jp_name", "like", "%" . $search_val . "%")
                ->orWhere("foreign_maker.foreign_maker_id", "like", "%" . $search_val . "%");
            })->get();

            $total_filtered = count($filter_res);
        }

        if ($filter['order'][0]["column"] > 0) {
            switch ($filter['order'][0]["column"]) {
                case 0:
                    $order_field = "foreign_maker.foreign_maker_id";
                    break;
                case 1:
                    $order_field = "foreign_maker.jp_name";
                    break;
                case 2:
                    $order_field = "foreign_maker.en_name";
                    break;
                case 3:
                    $order_field = "foreign_maker.maker_email";
                    break;
                case 4:
                    $order_field = "foreign_maker.maker_address";
                    break;
                case 5:
                    $order_field = "foreign_maker.maker_fax";
                    break;
                case 6:
                    $order_field = "foreign_maker.maker_phone";
                    break;
                case 7:
                    $order_field = "foreign_maker.maker_url";
                    break;
                default:
                    $order_field = "foreign_maker.foreign_maker_id";
            }

            $order_asc = "asc";
            if ($filter['order'][0]["dir"]) {
                $order_asc = $filter['order'][0]["dir"];
            }

            $query->orderBy($order_field, $order_asc);
        }

        if ($filter['length'] >= 0) {
            $data = $query->offset($filter['start'])->limit($filter['length'])->get();

        } else {
            $data = $query->get();
        }

        $result = array('data' => $data, 'recordsFiltered' => $total_filtered, 'recordsTotal' => $totals, 'draw' => $filter['draw']);

        return $result;
    }

        public static function getMakerList($filter){
    	$data = [];
        $query = DB::table('foreign_maker')->select('foreign_maker.*', 'country.country_jp_name', 'country.naccs', 'region.region_jp_name');

        $query->leftjoin('country', function($join){
            $join->on('foreign_maker.maker_country', '=', 'country.country_en_name');
        })->leftjoin('region', function($join){
            $join->on('foreign_maker.maker_region', '=', 'region.id');
        });

        $query->where('foreign_maker.maker_country','!=','');

        $totals = count($query->get());

        $total_filtered = $totals;

        if($filter["searchtype"]){
			//$filter_res = $query->where('')->get();

            //$total_filtered = count($filter_res);
        }

        if($filter["searchcountry"]){
			$filter_res = $query->where('country.id', $filter["searchcountry"])->get();

            $total_filtered = count($filter_res);
        }

        if($filter['searchregion']){
			$filter_res = $query->where('country.id', $filter["searchregion"])->get();

            $total_filtered = count($filter_res);
        }

        if($filter["searchquality"]){
			//$filter_res = $query->where('')->get();

            //$total_filtered = count($filter_res);
        }

        if($filter["search"]["value"]){
            $search_val = $filter["search"]["value"];

            $filter_res = $query->where(function($q) use($search_val) {
                            $q->Where("foreign_maker.jp_name", "like", "%".$search_val."%")
                                ->orWhere("country.country_jp_name", "like", "%".$search_val."%")
                                ->orWhere("region.region_jp_name", "like", "%".$search_val."%");

                          })->get();

            $total_filtered = count($filter_res);
        }

        if($filter['order'][0]["column"]>0){
            switch ($filter['order'][0]["column"]) {
                case 1:
                    $order_field = "foreign_maker.jp_name";
                    break;
                case 2:
                    $order_field = "country.country_jp_name";
                    break;
                case 3:
                    $order_field = "region.region_jp_name";
                    break;
                default:
                    $order_field = "foreign_maker.jp_name";
            }

            $order_asc = "asc";
            if( $filter['order'][0]["dir"] ){
                $order_asc = $filter['order'][0]["dir"];
            }

            $query->orderBy($order_field, $order_asc);
        }

        if( $filter['length'] >= 0 ){
            $data = $query->offset($filter['start'])->limit($filter['length'])->get();

        }else{
            $data = $query->get();
        }

        $result = array('data' => $data, 'recordsFiltered'=> $total_filtered, 'recordsTotal'=>$totals, 'draw'=>$filter['draw']);

        return $result;
    }
}
