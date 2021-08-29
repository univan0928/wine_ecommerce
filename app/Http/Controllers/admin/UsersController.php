<?php

namespace App\Http\Controllers\admin;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
class UsersController extends Controller
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
        $sort = -1;
        $you = auth('admin')->user();
        $users = Users::paginate(10);
        return view('dashboard.admin.usersList', compact('users', 'you','sort'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Users::find($id);
        return view('dashboard.admin.userShow', compact( 'user' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Users::find($id);
        return view('dashboard.admin.userEditForm', compact('user'));
    }

    public function search(Request $request){
        $searchText = $request->searchText;
        $count = $request->count;
        $sort = $request->sort;
        if($sort == 1)
            $tmp = Users::where('email','LIKE', "%{$searchText}%")->orderBy('email','desc');
        else if($sort ==0) $tmp = Users::where('email','LIKE', "%{$searchText}%")->orderBy('email','asc');
        else $tmp = Users::where('email','LIKE', "%{$searchText}%");
        $users = $tmp->paginate($count);
        $data = view('dashboard.admin.modal',compact('users','sort'))->render();
        return $data;
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
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256'
        ]);
        $user = Users::find($id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->save();
        $request->session()->flash('message', 'Successfully updated user');
        return redirect()->route('adminusers.index');
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
        $user = Users::find($id);
        if($user){
            $user->delete();
        }
        return redirect()->route('adminusers.index');
    }
}
