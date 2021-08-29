<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Estimates;
use App\Models\Maker;
use App\Models\Type;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakersController extends Controller
{
    //
    public function __construct(
        Maker $maker
    )
    {

        $this->middleware('admin');
        $this->maker = $maker;
    }
    public function create()
    {
        return view('dashboard.makers.create');
    }
    public function index()
    {
        $sort = -1;
        $makers = $this->maker->getAdminAll();
        $makers = $makers->paginate(25);
        return view('dashboard.makers.makersList', compact('makers','sort'));
    }

    public function list(Request $request){
        $makers = $this->maker->getDataFilter($request->input());

        return response()->json($makers);
    }
    public function edit($id)
    {
//        print_r($id); exit;
        $maker = $this->maker->getMaker($id);
        $country = DB::table('country')->get();
        return view('dashboard.makers.edit', compact('maker','country'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foreign_maker_id'             => 'required|unique:foreign_maker',
        ]);
        $product = Maker::create(
            [
                'foreign_maker_id'=>$request->input('foreign_maker_id'),
                'en_name'=>$request->input('en_name'),
                'jp_name'=>$request->input('jp_name'),
                'maker_address'=>$request->input('maker_address'),
                'maker_email'=>$request->input('maker_email'),
                'maker_phone'=>$request->input('maker_phone'),
                'maker_fax'=>$request->input('maker_fax'),
                'maker_url'=>$request->input('maker_url '),
            ]
        );
        $request->session()->flash('message', 'Successfully created maker');
        return redirect()->route('makers.index');
    }

    public function update(Request $request, $id)
    {

        $pdf_maker_name = $request->pdf_maker_name;
        if(isset($request->pdf_maker_image)&&$request->pdf_maker_image !='' ){

            $folderPath = public_path('images/thumbplaces/');

            $image_parts = explode(";base64,", $request->pdf_maker_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $pdf_maker_name = $request->foreign_maker_id.'.png';
        }

        $maker_name = $request->maker_name;
        if(isset($request->maker_image)&&$request->maker_image !='' ){

            $folderPath = public_path('images/detailmaker/');

            $image_parts = explode(";base64,", $request->maker_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $maker_name = $request->foreign_maker_id.'.png';
        }

        $maker_place_name = $request->maker_place_name;
        if(isset($request->maker_place_image)&&$request->maker_place_image !='' ){

            $folderPath = public_path('images/places/');

            $image_parts = explode(";base64,", $request->maker_place_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $maker_place_name = $request->foreign_maker_id.'.png';
        }

        $maker_place_name_2 = $request->maker_place_name_2;
        if(isset($request->maker_place_image_2)&&$request->maker_place_image_2 !='' ){

            $folderPath = public_path('images/places_2/');

            $image_parts = explode(";base64,", $request->maker_place_image_2);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $maker_place_name_2 = $request->foreign_maker_id.'.png';
        }

        $maker_place_name_3 = $request->maker_place_name_3;
        if(isset($request->maker_place_image_3)&&$request->maker_place_image_3 !='' ){

            $folderPath = public_path('images/places_3/');

            $image_parts = explode(";base64,", $request->maker_place_image_3);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $maker_place_name_3 = $request->foreign_maker_id.'.png';
        }

        $maker_pdf_name = $request->maker_pdf_name;
        if(isset($request->maker_pdf_image)&&$request->maker_pdf_image !='' ){

            $folderPath = public_path('images/bigplaces/');

            $image_parts = explode(";base64,", $request->maker_pdf_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . $request->foreign_maker_id . '.png';

            file_put_contents($file, $image_base64);
            $maker_pdf_name = $request->foreign_maker_id.'.png';
        }

        $product = Maker::where('foreign_maker_id',$id)->update(
            [
                'en_name'=>$request->input('en_name'),
                'jp_name'=>$request->input('jp_name'),
                'jp_full_name'=>mb_convert_kana($request->input('jp_name'),'KVC'),
                'maker_address'=>$request->input('maker_address'),
                'maker_email'=>$request->input('maker_email'),
                'maker_phone'=>$request->input('maker_phone'),
                'maker_fax'=>$request->input('maker_fax'),
                'maker_region'=>$request->input('maker_region'),
                'maker_rating'=>$request->input('maker_rating'),
                'maker_url'=>$request->input('maker_url'),
                'maker_country'=>$request->input('country'),
                'maker_description'=>$request->input('maker_description'),
                'pdf_maker_name'=>$pdf_maker_name,
                'maker_name'=>$maker_name,
                'maker_place'=>$maker_place_name,
                'maker_place_2'=>$maker_place_name_2,
                'maker_place_3'=>$maker_place_name_3,
                'pdf_maker_place'=>$maker_pdf_name,

            ]
        );
        $request->session()->flash('message', 'Successfully edited note');
        return redirect()->route('makers.index');
    }
    public function destroy(Request $request)
    {
        $id = $request->user_name;

        DB::table('foreign_maker')->where('foreign_maker_id', $id)->delete();
        return redirect()->route('makers.index');
    }
}
