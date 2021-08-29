<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Product;
use App\Models\Maker;
use App\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Home $home,
        Product $product,
        Maker $maker
    )
    {
        $this->middleware('auth');
        $this->home = $home;
        $this->product = $product;
        $this->maker = $maker;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home(){
        $result['navbar'] = 'home';
        $result['available_products'] = $this->product->availableProductst();
        return view('home')->with('result',$result);
    }

    public function customer(Request $request){
          $id = $request->id;
          $result = $this->home->getCustomer($id);
          return view('common.customer')->with('result',$result);
    }

    public function customerinfo(Request $request){
          $search_name = $request->search_name;
          $result = Customer::where('name', 'like', '%'.$search_name.'%')->get();

          return response()->json($result);
    }

    public function findWine($page=25)
    {
        $result['all_products'] = $this->product->allProducts($page);
        $result['all_countries'] = $this->home->allCountries();
        $result['all_regions'] = $this->home->allRegions();
        $result['total_count'] = Product::get()->count();
        $result['navbar'] = 'findWine';

        return view('findwine')->with('result',$result);
    }

    public function makerRanking()
    {
        $result['types'] = array();
        $result['qualities'] = array();
        $result['all_countries'] = $this->home->allCountries();
        $result['all_regions'] = $this->home->allRegions();

        $result['navbar'] = 'makerRanking';

        return view('makerranking')->with('result',$result);
    }

    public function productRanking()
    {
        $result['all_products'] = $this->product->allProducts();
        $result['all_countries'] = $this->home->allCountries();
        $result['all_makers'] = $this->maker->getAll();
        $result['all_taste'] = $this->home->allTypes();
        $result['all_type'] = array(
            '1' => __('wine.Still wine'),
            '4' => __('wine.Sparkling wine'),
        );

        $result['navbar'] = 'wineRanking';

        return view('productRanking')->with('result',$result);
    }

    public function advancedSearch(){
        $result['all_countries'] = $this->home->allCountries();
        $result['all_regions'] = $this->home->allRegions();
        $result['quality_origin'] = $this->home->allQuality();
        $result['certification'] = $this->home->allCertification();
        $result['navbar'] ='';
        return view('advancedsearch')->with('result',$result);
    }

    public function rangeSearch(){
        $result['all_countries'] = $this->home->allCountries();
        $result['all_regions'] = $this->home->allRegions();
        $result['navbar'] ='';
        return view('rangesearch')->with('result',$result);
    }

    public function refreshAjax(){
        return view('common.rangerefresh');
    }
}
