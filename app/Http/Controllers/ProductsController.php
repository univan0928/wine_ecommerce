<?php

namespace App\Http\Controllers;
use App\Exports\MakersExport;
use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Maker;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    //


    public function __construct(
        Product $product,
        Home $home,
        Maker $maker
    ){
        $this->middleware('auth', ['except' => ['productexport', 'makerexport']]);
        $this->product = $product;
        $this->home = $home;
        $this->maker = $maker;
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit','768M');
    }

    public function productexport()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function makerexport()
    {
        return Excel::download(new MakersExport, 'makers.xlsx');
    }

    public function ajaxSearch(Request $request){
        $result = $this->product->filterProducts($request,$page = 25);

        $region = $this->home->countryRegions($request);

        $data[0] = view('products.modal')->with('result', $result)->render();
//                    (string)view('products.pagination')->with('result',$result)->with('page', $page)->with('page_count', $page_count);
        $data[1] = $result['total_count'];
        $data[2] = view('common.regionlist')->with('result',$region);

        return $data;
    }

    public function ajaxAvailableProduct(Request $request, $page=1){
        $result = $this->product->availableProducts($request, $page-1);

        $region = $this->home->countryRegions($request);
        $page_count = floor($result['total_count'] / 18)+1;

        $data[0] = (string)view('products.available')->with('result', $result['products']).
                    (string)view('products.pagination')->with('result',$result)->with('page', $page)->with('page_count', $page_count);
        $data[1] = $result['total_count'];
        $data[2] = (string)view('common.regionlist')->with('result',$region);

        return $data;
    }

    public function ajaxMakerList(Request $request){
        $result = Maker::getMakerList($request->input());

        return response()->json($result);
    }

    public function ajaxProductList(Request $request){
        $result = Product::ajaxProductList($request->input());

        return response()->json($result);
    }

    public function ajaxRegions(Request $request){
        $region = $this->home->countryRegions($request);
        $data = (string)view('common.regionlist')->with('result',$region);
        return $data;
    }

    public function getRegionByCountry(Request $request){
        $region = $this->home->getRegionByCountry($request);

        return response()->json($region);
    }

    public function ajaxRedVariety(Request $request){
        $variety['check'] = $request->check;
        $variety['uncheck'] = $request->uncheck;
        $variety['cnt'] = $request->cnt;
        $variety['tmp'] = $request->tmp;
        $variety['search'] = $this->product->redVariety($request);
        $data = (string)view('common.variety1')->with('result',$variety);
        return $data;
    }

    public function ajaxWhiteVariety(Request $request){
        $variety['check'] = $request->check;
        $variety['uncheck'] = $request->uncheck;
        $variety['cnt'] = $request->cnt;
        $variety['tmp'] = $request->tmp;
        $variety['search'] = $this->product->whiteVariety($request);
        $data = (string)view('common.variety')->with('result',$variety);
        return $data;
    }

    public function advancedResult(Request $request){
        $result = [];
        $result = $this->product->advancedSearch($request);
        $result['all_count'] = Product::get()->count();
        $result['navbar'] = '';
        $filter = $result['filter'];
        return view('searchresult',compact('result','filter'));
    }

    public function advancedAjaxResult(Request $request){
        $result = [];
        $result = $this->product->advancedSearch($request);
        $result['all_count'] = Product::get()->count();
        $result['navbar'] = '';
        $filter = $result['filter'];
        return view('products.rangeSearch',compact('result','filter'));
    }

    public function totalFind(Request $request){
        $result = [];
        $result = $this->product->totalSearch($request);
        $result['all_count'] = Product::get()->count();
        $result['navbar'] = '';
        $content = $request->content;
        return view('searchresulttotal',compact('result','content'));
    }

    public function totalAjaxFind(Request $request){
        $result = [];
        $result = $this->product->totalSearch($request);
        $result['all_count'] = Product::get()->count();
        $result['navbar'] = '';
        $content = $request->content;
        return view('products.totalSearch',compact('result','content'));
    }

    public function  detail(Request $request){
        $result['product'] = $this->product->getProduct($request->id);
        $result['navbar'] = '';
        if(isset($result['product']))
          return view('productdetail')->with('result', $result);
        else abort(404);
    }
    public function  makerdetail(Request $request){
        $result['maker'] = $this->maker->getMaker($request->id);
        $result['all_products'] = $this->product->detailProducts($request->id);
        $result['navbar'] = '';
        if(isset($result['maker']))
            return view('makerdetail')->with('result', $result);
        else abort(404);
    }
}
