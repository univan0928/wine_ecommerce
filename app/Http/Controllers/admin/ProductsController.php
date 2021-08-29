<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\Status;
use App\Http\Controllers\Controller;
class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Product $product,
        Type $type
    )
    {
//        $this->middleware('auth');
        $this->middleware('admin');
        $this->product = $product;
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sort = -1;
//        $products = Product::paginate( 20 );
        $products = $this->product->adminProducts();
        $products = $products->paginate(25);
        return view('dashboard.products.productsList', compact('products','sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('dashboard.notes.create', [ 'statuses' => $statuses ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){

        $adminProducts = $this->product->adminProducts();
        $searchText = $request->searchText;

        $count = $request->count;
        $sort = $request->sort;

        if($sort == 0)
            $tmp = $adminProducts->where('full_product_name','LIKE', "%{$searchText}%")->orderBy('full_product_name','asc');
        elseif($sort == 1) $tmp = $adminProducts->where('full_product_name','LIKE', "%{$searchText}%")->orderBy('full_product_name','desc');
        else $tmp = $adminProducts->where('full_product_name','LIKE', "%{$searchText}%");

        $products = $tmp->paginate($count);

        $data = view('dashboard.products.modal',compact('products','sort'))->render();

        return $data;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required'
        ]);
        $user = auth()->user();
        $note = new Notes();
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->users_id = $user->id;
        $note->save();
        $request->session()->flash('message', 'Successfully created note');
        return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Notes::with('user')->with('status')->find($id);
        return view('dashboard.notes.noteShow', [ 'note' => $note ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->getProduct($id);
        $taste = Type::all();
        $country = DB::table('country')->get();
        return view('dashboard.products.edit', compact('product','taste','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $product_name = $request->image_name;
        if(isset($request->product_image)&&$request->product_image !='' ){

            $folderPath = public_path('images/products/');

            $image_parts = explode(";base64,", $request->product_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->product_code . '.png';

            file_put_contents($file, $image_base64);
            $product_name = $request->product_code.'.png';
        }

        $big_product_name = $request->big_image_name;

        if(isset($request->big_product_image)&&$request->big_product_image !='' ){

            $folderPath = public_path('images/bigproducts/');

            $image_parts = explode(";base64,", $request->big_product_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->product_code . '.png';

            file_put_contents($file, $image_base64);
            $big_product_name = $request->product_code.'.png';
        }


        $pdf_product_name = $request->pdf_image_name;

        if(isset($request->pdf_product_image)&&$request->pdf_product_image !='' ){

            $folderPath = public_path('images/pdfproducts/');

            $image_parts = explode(";base64,", $request->pdf_product_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->product_code . '.png';

            file_put_contents($file, $image_base64);
            $pdf_product_name = $request->product_code.'.png';
        }

        $validatedData = $request->validate([
            'product_code'             => 'required',

        ]);
        $product = Product::where('product_code',$id)->update(
            [
                'product_code' => $request->input('product_code'),
                'color' => $request->input('color'),
                'vintage_year' => $request->input('vintage_year'),
                'full_product_name' => $request->input('full_product_name'),
                'product_name'=>mb_convert_kana($request->input('full_product_name'),'KVC'),
                'full_english_name' => $request->input('full_english_name'),
                'jan_code'=>$request->input('jan_code'),
                'amount'=>$request->input('amount'),
                'bottles_per_case'=>$request->input('bottles_per_case'),
                'case_price'=>$request->input('case_price'),
                'shop_price'=>$request->input('shop_price'),
                'type_code'=>$request->input('type_id'),
                'current_stock'=>$request->input('current_stock'),
                'cap'=>$request->input('cap'),
                'wine_type' => $request->input('wine_type'),
                'description' => $request->input('description'),
                'local_area' => $request->input('local_area'),
                'region' => $request->input('region'),
                'village' => $request->input('village'),
                'certification' => $request->input('certification'),
                'variety' => $request->input('variety'),
                'rate' => $request->input('rate'),
                'foreign_maker_code' => $request->input('foreign_maker_code'),
                'image_name'=>$product_name,
                'big_image_name'=>$big_product_name,
                'pdf_image_name'=>$pdf_product_name,

            ]
        );
        $request->session()->flash('message', 'Successfully edited note');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->user_name;
        DB::table('product')->where('product_code', $id)->delete();
        return redirect()->route('products.index');
    }
}
