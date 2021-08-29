<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\EstimateDetail;
use App\Models\Estimates;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class EstimatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    //
    public function index(){
        $estimates = Estimates::with('user', 'maker', 'customer')->orderby('created_at', 'desc')->paginate( 20 );
        return view('dashboard.estimates.estimatesList',['estimates' => $estimates]);
    }

    public function list(Request $request){
    	$estimates = Estimates::getDataFilter($request->input());

        return response()->json($estimates);
    }

    public function detail($id){
        $result = [];
        $estimate = Estimates::where('estimate_number', $id)->first();
        $tmp = EstimateDetail::where('estimate_id',$estimate->id)->get();
        $customer = Customer::find($estimate->customer_id);
        $user = \App\User::find($estimate->user_id);
        foreach($tmp as $row){
            $product = Product::where('product_code',$row->product_id)->first();
            $row->shop_price = $product->shop_price;
            $row->case_price = $product->case_price;
            $row->color = $product->color;
            $row->vintage_year = $product->vintage_year;
            $row->full_product_name = $product->full_product_name;
            $row->image_name = $product->image_name;
            $taste = Type::find($product->type_code);
            $row->taste = $taste->type_name;
            $result[] = $row;
        }
        return view('dashboard.estimates.estimateShow',compact('estimate','result','customer','user'));

    }

    public function showPdf($id, Request $request){
    	$filename = $id.'.pdf';
		$path = storage_path('app/public/estimate/'.$id.'.pdf');

		if(Storage::exists('public/estimate/'.$id.'.pdf')) {
			if($request->get('file_check') == true){
				echo json_encode(true);
				exit;
			}else{
				return Response::make(file_get_contents(Storage::path('public/estimate/'.$id.'.pdf')), 200, [
				    'Content-Type' => 'application/pdf',
				    'Content-Disposition' => 'inline; filename="'.$filename.'"'
				]);
			}

		}else{
			echo json_encode(false);
			exit;
		}

    }
}
