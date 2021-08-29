<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\EstimateDetail;
use App\Models\Home;
use App\Models\Maker;
use App\Models\Product;
use App\Models\Customer;
//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function __construct(
        Product $product,
        Home $home,
        Cart $cart,
        Maker $maker
    ){
        $this->middleware('auth');
        $this->product = $product;
        $this->home = $home;
        $this->cart = $cart;
        $this->maker = $maker;
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit','768M');
    }


    public function cart(){
        $result['navbar'] = '';
        $customers = Customer::all();

        $data = array('result'=>$result, 'customers' => $customers);

        return view('cart')->with($data);
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function createPDF(Request $request){

//        $products = DB::table('product')->get();
//
//        foreach($products as $product) {
//            if (!isset($product->image_name) || $product->image_name == ''){
//                DB::table('product')->where('product_code', $product->product_code)->update(['current_stock' => 0]);
//            }
//        }

//            $makers = DB::table('foreign_maker')->get();
//
//            foreach($makers as $maker){
//                    DB::table('foreign_maker')->where('foreign_maker_id',$maker->foreign_maker_id)
//                        ->update([
//                            'jp_full_name'=>mb_convert_kana($maker->jp_name,'KVC')
//                        ]);
//            }


        $customer_id = $request->id;

        $customer = Customer::where('id', $customer_id)->first();
        $data = $this->cart->getEstimate($customer_id);
        $estimate = $data->estimate_number;
        $result = [];
        $quantity = [];
        $count = [];
        $makers = [];
        $maker = '';
        $cart = session()->get('cart');
        $val = 0;
        if(isset($cart)){
            foreach($cart as $id => $details){
                if($details['case'] == 'ケース'){
                    $tmp = explode('_case',$id);
                    $id = $tmp[0];
                }
                $product = $this->product->getProduct($id);
                if($details['case'] == 'ケース') $product->pdf_id = 1;
                else $product->pdf_id = 0;
                $product->pdf_quantity = $details['quantity'];
                array_push($result,$product);

                $detail = new EstimateDetail();
                $detail->estimate_id = $data->id;
                $detail->product_id = $id;
                $detail->quantity = $details['quantity'];
                $detail->bottle_case_state = $product->pdf_id;
                $detail->save();

                $maker_code = $product->foreign_maker_code;

                if(!isset($count[$maker_code])) {
                    $count[$maker_code] = $details['quantity'];
                    $makers_info = $this->maker->getMaker($maker_code);
                    array_push($makers,$makers_info);
                }
                else $count[$maker_code] += $details['quantity'];
                if($count[$maker_code] > $val) {

                    $maker = $maker_code;
                    $val = $count[$maker_code];
                }
            }
        }
        $maker_info = $this->maker->getMaker($maker);


        // share data to view
            $pdf = PDF::loadView('cartpdf',array('result'=>$result,'quantity'=>$quantity,'estimate'=>$estimate,'customer'=>$customer,'topmaker'=>$maker_info,'makers'=>$makers))
            ->setPaper('a4')
            ->setOptions([
                'chroot'  => public_path(),
            ]);

        Storage::put('public/estimate/'.$estimate.'.pdf', $pdf->output());

        // download PDF file with download method
        return $pdf->download($estimate.'.pdf');
    }

    public function tmp(){
        $result = [];
        $cart = session()->get('cart');
        if(isset($cart)){
            foreach($cart as $id => $details){
                array_push($result,$this->product->getProduct($id));
            }
        }
        return view('cartpdf')->with('result',$result);
    }

    public function clearCart(){
        $cart = session()->get('cart');
        if(isset($cart)) {
            unset($cart);
            session()->put('cart', null);
        }
        session()->flash('success', 'Product removed successfully');
        return redirect()->back();
    }

    //
    public function addToCart(Request $request){
        $id = $request->id;
        if(!isset($id)||$id == ''){
            return view('common.cartrefresh');
        }
        $product = $this->product->getProduct($id);
        $cart = session()->get('cart');
        if(!$cart){
            $cart = [
                $id=>[
                    "name"=>$product->full_product_name,
                    "quantity"=>1,
                    "price"=>$product->shop_price,
                    "photo"=>$product->image_name,
                    "id"=>$product->product_code,
                    "year"=>$product->vintage_year,
                    "color" =>$product->color,
                    "taste" => $product->type_name,
                    "case" =>'瓶'
                ]
            ];
            session()->put('cart',$cart);
            return view('common.cartrefresh');
        }

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
            session()->put('cart',$cart);
            return view('common.cartrefresh');
        }

        $cart[$id]=[
            "name"=>$product->full_product_name,
            "quantity"=>1,
            "price"=>$product->shop_price,
            "photo"=>$product->image_name,
            "id"=>$product->product_code,
            "year"=>$product->vintage_year,
            "color" =>$product->color,
            "taste" => $product->type_name,
            "case" =>'瓶'
        ];
        session()->put('cart',$cart);

        return view('common.cartrefresh');
    }

    public function addCaseToCart(Request $request){
        $id = $request->id;
        if(!isset($id)||$id == ''){
            return view('common.cartrefresh');
        }
        $case_id = $id."_case";
        $product = $this->product->getProduct($id);
        $cart = session()->get('cart');
        if(!$cart){
            $cart = [
                $case_id=>[
                    "name"=>$product->full_product_name,
                    "quantity"=>1,
                    "price"=>$product->case_price,
                    "photo"=>$product->image_name,
                    "id"=>$product->product_code,
                    "year"=>$product->vintage_year,
                    "color" =>$product->color,
                    "taste" => $product->type_name,
                    "case" =>'ケース'
                ]
            ];
            session()->put('cart',$cart);
            return view('common.cartrefresh');
        }

        if(isset($cart[$case_id])){
            $cart[$case_id]['quantity'] +=1;
            session()->put('cart',$cart);
            return view('common.cartrefresh');
        }

        $cart[$case_id]=[
            "name"=>$product->full_product_name,
            "quantity"=>1,
            "price"=>$product->case_price,
            "photo"=>$product->image_name,
            "id"=>$product->product_code,
            "year"=>$product->vintage_year,
            "color" =>$product->color,
            "taste" => $product->type_name,
            "case" =>'ケース'
        ];
        session()->put('cart',$cart);

        return view('common.cartrefresh');
    }
}
