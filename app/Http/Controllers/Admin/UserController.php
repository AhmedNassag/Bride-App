<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Localization;
use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role',2)->get();
        return view('admin.users.index')->with('users',$users);
    }

    public function create()
    {
        $cities = Localization::where('parent_id',Null)->get();
        $locations = Localization::where('parent_id','!=',Null)->get();
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $user = User::create
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
        ]);
        if($user)
        {
            Session::flash('statuscode','success');
            return redirect('/users')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/users')->with('status','Data Not Added');
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        $cities = Localization::where('parent_id',Null)->get();
        $locations = Localization::where('parent_id','!=',Null)->get();
        return view('admin.users.edit',compact('user','cities','locations'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(! $user)
        {
            return redirect()->back();
        }
        $user -> update
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => $request -> password,
        ]);

        if($user)
        {
        Session::flash('statuscode','success');
        return redirect('/users')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/users')->with('status','Data Not Updated');
        }
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
