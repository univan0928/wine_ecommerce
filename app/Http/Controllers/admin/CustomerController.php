<?php

namespace App\Http\Controllers\admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\Status;
use App\Http\Controllers\Controller;
class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('dashboard.customer.customerList', ['customers' => $customers]);
    }

    public function search(Request $request){
        $searchText = $request->searchText;
        $count = $request->count;

        $tmp = Customer::where('name','LIKE', "%{$searchText}%");
        $customers = $tmp->paginate($count);
        $data = view('dashboard.customer.modal')->with('customers',$customers)->render();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
            'address'           => 'required',
            'post_code'         => 'required',
            'tel'   => 'required',
            'fax'         => 'required',
            'email'=>'required',
        ]);

        $customer = new Customer();

        $customer->name     = $request->input('name');
        $customer->address  = $request->input('address');
        $customer->postcode = $request->input('post_code');
        $customer->tel = $request->input('tel');
        $customer->fax = $request->input('fax');
        $customer->email = $request->input('email');
        $customer->save();
        $request->session()->flash('message', 'Successfully created note');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('dashboard.customer.customerShow', [ 'customer' => $customer ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('dashboard.customer.edit', [ 'customer' => $customer ]);
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
        $validatedData = $request->validate([
            'name'             => 'required',
            'address'           => 'required',
            'post_code'         => 'required',
            'tel'   => 'required',
            'fax'         => 'required',
            'email'         => 'required'
        ]);

        $customer = Customer::find($id);

        $customer->name     = $request->input('name');
        $customer->address  = $request->input('address');
        $customer->postcode = $request->input('post_code');
        $customer->tel = $request->input('tel');
        $customer->fax = $request->input('fax');
        $customer->email = $request->input('email');
        $customer->save();
        $request->session()->flash('message', 'Successfully edited note');
        return redirect()->route('customer.index');
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
        $customer = Customer::find($id);
        if($customer){
            $customer->delete();
        }
        return redirect()->route('customer.index');
    }
}
