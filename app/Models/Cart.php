<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Cart extends Model
{
    public $timestamps = true;
    protected $fillable = ["created_at"];
    //
    public function getEstimate($customer_id=0){
        $current_date = intval(date('Ymd'));
        $last = DB::table('estimate')->latest('id')->first();

        if(isset($last) && $last !=''){
            $previous_date = intval($last->estimate_number/1000);
            $cnt = $last->estimate_number%1000;
            if($previous_date == $current_date) {
                $cnt ++;
            }
            else $cnt = 1;
        }
        else $cnt = 1;
        $result = $current_date*1000 + $cnt;
        if (Auth::check()) {
            //there is a user logged in, now to get the id
            $id = Auth::user()->id;
        }
        DB::table('estimate')->insert(array('estimate_number' => $result, 'user_id'=>$id, 'customer_id' => $customer_id, 'created_at'=>date('Y-m-d H:i:s')));
        $data = DB::table('estimate')->where('estimate_number',$result)->first();
        return $data;
    }
}
