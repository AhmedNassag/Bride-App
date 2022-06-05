<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Localization;
use Illuminate\Http\Request;
use App\User;


class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role',0)->get();
        return view('admin.admins.index')->with('admins',$admins);
    }

    public function create()
    {
        $cities = Localization::where('parent_id',Null)->get();
        $locations = Localization::where('parent_id','!=',Null)->get();
        return view('admin.admins.create',compact('cities','locations'));
    }


    public function store(Request $request)
    {
        $admin = User::create
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
        ]);
        if($admin)
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
        $admin = User::find($id);
        $cities = Localization::where('parent_id',Null)->get();
        $locations = Localization::where('parent_id','!=',Null)->get();
        return view('admin.admins.edit',compact('admin','cities','locations'));
    }


    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        $admin -> update
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => $request -> password,
        ]);

        if($admin)
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
        $admin = User::findOrFail($id);
        $admin ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
