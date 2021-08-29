<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{

    //
    public function allCountries() {
        $country = DB::table('country')->get();

        return $country;
    }

    public function getCustomer($name){
        if(isset($name)) $customer = DB::table('customer')->where('customer.name',$name)->get()->first();
        if(!isset($customer)) $customer = DB::table('customer')->get()->first();
        return $customer;
    }

    public function allRegions() {
        $country = DB::table('region')->get();
        return $country;
    }
    public function countryRegions($filter){
        $country = DB::table('country');
        $country->where('country_en_name',$filter->countryList);
        $result = $country->get()->first();
        return $result;
    }

    public function getRegionByCountry($filter){
        $region = DB::table('region');
        $region->where('country_id',$filter->country_id);
        $result = $region->get();
        return $result;
    }

    public function  allQuality(){
        $quality = DB::table('quality_origin')->get();
        return $quality;
    }

    public function  allTypes(){
        $type = DB::table('type')->get();
        return $type;
    }

    public function allCertification(){
        $certification = DB::table('certification')->get();
        return $certification;
    }
}
