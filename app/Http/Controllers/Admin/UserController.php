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


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','User')->get();
        return view('admin.users.index',compact('users'));
    }

    public function show($id)
    {
        $user      = User::find($id);
        $phones    = Phone::where('user_id',$user->id)->get();
        $social    = Social::where('user_id',$user->id)->first();
        $packages  = Package::where('user_id',$user->id)->get();
        $galleries = Gallery::where('user_id',$user->id)->get();
        $locations = Location::where('user_id',$user->id)->get();
        return view('admin.users.show',compact('user','phones','social','packages','locations'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'avatar'   => 'required|nullable|image|mimes:png,jpeg,jpg',
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
        $user = User::create
        ([
            'name'        => $request -> name,
            'email'       => $request -> email,
            'password'    => encrypt($request -> password),
            'role'        => $request -> role,
            'avatar'      => $file_name,
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
        return view('admin.users.edit',compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(! $user)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|min:6',
            'avatar'   => 'required|nullable|image|mimes:png,jpeg,jpg',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file_name = $user->avatar;
        if($request->file('avatar'))
        {
            $file_extension = $request->avatar->getClientOriginalExtension();
            $file_name      = time().'.'.$file_extension;
            $path           = 'avatar';
            $request->avatar->move($path,$file_name);
        }
        $user -> update
        ([
            'name'     => $request -> name,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
            'role'     => $request -> role,
            'avatar'   => $file_name,
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


    public function change($id)
    {
        $user = User::find($id);
        if ($user->status !== '1')
        {
            $user->update(['status' => 1]);
        }
        else
        {
            $user->update(['status' => 2]);
        }
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


    public function changeToAdmin($id)
    {
        $user = User::findOrFail($id);
        if(! $user)
        {
            return redirect()->back();
        }
        $user->update(['role' => 'Admin']);
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


    public function changeToUser($id)
    {
        $user = User::findOrFail($id);
        if(! $user)
        {
            return redirect()->back();
        }
        $user->update(['role' => 'User']);
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

    public function changeToMakeupArtist($id)
    {
        $user = User::findOrFail($id);
        if(! $user)
        {
            return redirect()->back();
        }
        $user->update(['role' => 'MakeupArtist']);
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
}
