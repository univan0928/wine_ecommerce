<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Estimates extends Model
{
    //
    protected $table = "estimate";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function maker()
    {
        return $this->belongsTo('App\Models\Maker', 'maker_code', 'foreign_maker_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public static function getDataFilter($filter){
    	$data = [];           
        $query = DB::table('estimate')->select('estimate.*', 'users.name as user_name', 'foreign_maker.jp_name as maker_jp_name', 'customer.name as customer_name');

	        $query->leftjoin('users', function($join){
	            $join->on('estimate.user_id', '=', 'users.id');
	        })->leftjoin('foreign_maker', function($join){
	            $join->on('estimate.maker_code', '=', 'foreign_maker.foreign_maker_id');
	        })->leftjoin('customer', function($join){
	            $join->on('estimate.customer_id', '=', 'customer.id');
	        });

        $totals = count($query->get());

        $total_filtered = $totals;       

        if($filter["search"]["value"]){
            $search_val = $filter["search"]["value"];

            $filter_res = $query->where(function($q) use($search_val) {
               
                $q->Where("estimate.estimate_number", "like", "%".$search_val."%")
                    ->orWhere("estimate.created_at", "like", "%".$search_val."%")
                    ->orWhere("users.name", "like", "%".$search_val."%")
                    ->orWhere("foreign_maker.jp_name", "like", "%".$search_val."%")   
                    ->orWhere("customer.name", "like", "%".$search_val."%");

              })->get();

            $total_filtered = count($filter_res);    
        }

        if($filter['order'][0]["column"]>0){
            switch ($filter['order'][0]["column"]) {
                case 0:
                    $order_field = "estimate.estimate_number";                
                    break;
                case 1:
                    $order_field = "users.name";                
                    break;  
                case 2:
                    $order_field = "estimate.created_at";                
                    break;          
                case 3:
                    $order_field = "foreign_maker.jp_name";                
                    break;
                case 4:
                    $order_field = "customer.name";                
                    break;                           
                default:    
                    $order_field = "estimate.created_at";                
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
