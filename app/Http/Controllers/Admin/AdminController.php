<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Location;
use App\Models\Package;
use App\Models\Gallery;
use App\Models\Social;
use App\Models\Phone;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role','Admin')->get();
        return view('admin.admins.index',compact('admins'));
    }

    public function show($id)
    {
        $admin  = User::find($id);
        $phones = Phone::where('user_id',$admin->id)->get();
        $social = Social::where('user_id',$admin->id)->first();
        $packages = Package::where('user_id',$admin->id)->get();
        $galleries = Gallery::where('user_id',$admin->id)->get();
        $locations = Location::where('user_id',$admin->id)->get();
        return view('admin.admins.show',compact('admin','phones','social','packages','locations'));
    }


    public function create()
    {
        return view('admin.admins.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'avatar'   => 'sometimes|nullable|image|mimes:png,jpeg,jpg',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file_name = 'no-avatar.png';
        if($request->file('avatar'))
        {
            $file_extension = $request->avatar->getClientOriginalExtension();
            $file_name      = time().'.'.$file_extension;
            $path           = 'avatar';
            $request->avatar->move($path,$file_name);
        }
        $admin = User::create
        ([
            'name'     => $request -> name,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
            'role'     => $request -> role,
            'avatar'   => $file_name,
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
        $admin = User::find($id);
        return view('admin.admins.edit',compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'avatar'   => 'sometimes|nullable|image|mimes:png,jpeg,jpg',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file_name = $admin->avatar;
        if($request->file('avatar'))
        {
            $file_extension = $request->avatar->getClientOriginalExtension();
            $file_name      = time().'.'.$file_extension;
            $path           = 'avatar';
            $request->avatar->move($path,$file_name);
        }
        $admin -> update
        ([
            'name'     => $request -> name,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
            'role'     => $request -> role,
            'avatar'   => $file_name,
        ]);
        if($admin)
        {
        Session::flash('statuscode','success');
        return redirect('/admins')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/admins')->with('status','Data Not Updated');
        }
    }


    public function delete($id)
    {
        $admin = User::findOrFail($id);
        $admin ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }


    public function change($id)
    {
        $admin = User::find($id);
        if ($admin->status !== '1')
        {
            $admin->update(['status' => 1]);
        }
        else
        {
            $admin->update(['status' => 2]);
        }
        if($admin)
        {
            Session::flash('statuscode','success');
            return redirect('/admins')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/admins')->with('status','Data Not Updated');
        }
    }


    public function changeToAdmin($id)
    {
        $admin = User::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        $admin->update(['role' => 'Admin']);
        if($admin)
        {
            Session::flash('statuscode','success');
            return redirect('/admins')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/admins')->with('status','Data Not Updated');
        }
    }


    public function changeToUser($id)
    {
        $admin = User::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        $admin->update(['role' => 'User']);
        if($admin)
        {
            Session::flash('statuscode','success');
            return redirect('/admins')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/admins')->with('status','Data Not Updated');
        }
    }

    public function changeToMakeupArtist($id)
    {
        $admin = User::findOrFail($id);
        if(! $admin)
        {
            return redirect()->back();
        }
        $admin->update(['role' => 'MakeupArtist']);
        if($admin)
        {
            Session::flash('statuscode','success');
            return redirect('/admins')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/admins')->with('status','Data Not Updated');
        }
    }
}
