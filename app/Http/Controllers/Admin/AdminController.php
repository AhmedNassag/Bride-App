<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;
use App\User;


class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role','Admin')->get();
        $phones = Phone::all();
        return view('admin.admins.index',compact('admins','phones'));
    }

    public function show($id)
    {
        $admin     = User::find($id);
        return view('admin.admins.edit',compact('admin','city','location'));
    }

    public function create()
    {
        return view('admin.admins.create',compact('cities','locations'));
    }


    public function store(Request $request)
    {
        $file_extension = $request->avatar->getClientOriginalExtension();
        $file_name      = time().'.'.$file_extension;
        $path           = 'avatar';
        $request->avatar->move($path,$file_name);
        $admin = User::create
        ([
            'name'        => $request -> name,
            'avatar'      => $file_name,
            'role'        => $request -> role,
            'city_id'     => $request -> city,
            'location_id' => $request -> location,
            'email'       => $request -> email,
            'password'    => encrypt($request -> password),
        ]);
        if($admin)
        {
            Session::flash('statuscode','success');
            return redirect('/admins')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/admins')->with('status','Data Not Added');
        }
    }


    public function edit($id)
    {
        $admin     = User::find($id);
        $cities    = Localization::where('parent_id',Null)->get();
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
        $file_extension = $request->avatar->getClientOriginalExtension();
        $file_name      = time().'.'.$file_extension;
        $path           = 'avatar';
        $request->avatar->move($path,$file_name);
        $admin -> update
        ([
            'name'        => $request -> name,
            'avatar'      => $file_name,
            'role'        => $request -> role,
            'city_id'     => $request -> city,
            'location_id' => $request -> location,
            'email'       => $request -> email,
            'password'    => encrypt($request -> password),
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
