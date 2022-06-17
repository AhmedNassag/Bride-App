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

class MakeupArtistController extends Controller
{
    public function index()
    {
        $makeupArtists = User::where('role','MakeupArtist')->get();
        return view('admin.makeup artists.index',compact('makeupArtists'));
    }

    public function show($id)
    {
        $makeupArtist = User::find($id);
        $phones       = Phone::where('user_id',$makeupArtist->id)->get();
        $social       = Social::where('user_id',$makeupArtist->id)->first();
        $packages     = Package::where('user_id',$makeupArtist->id)->get();
        $galleries    = Gallery::where('user_id',$makeupArtist->id)->get();
        $locations    = Location::where('user_id',$makeupArtist->id)->get();
        return view('admin.makeup artists.show',compact('makeupArtist','phones','social','packages','locations'));
    }


    public function create()
    {
        return view('admin.makeup artists.create');
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
        $makeupArist = User::create
        ([
            'name'     => $request -> name,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
            'role'     => $request -> role,
            'avatar'   => $file_name,
        ]);

        if($makeupArist)
        {
            Session::flash('statuscode','success');
            return redirect('/makeupArtists')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/makeupArtists')->with('status','Data Not Added');
        }
    }


    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.makeup artists.edit',compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $makeupArtist = User::findOrFail($id);
        if(! $makeupArtist)
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
        $file_name = $makeupArtist->avatar;
        if($request->file('avatar'))
        {
            $file_extension = $request->avatar->getClientOriginalExtension();
            $file_name      = time().'.'.$file_extension;
            $path           = 'avatar';
            $request->avatar->move($path,$file_name);
        }
        $makeupArtist -> update
        ([
            'name'     => $request -> name,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
            'role'     => $request -> role,
            'avatar'   => $file_name,
        ]);
        if($makeupArtist)
        {
        Session::flash('statuscode','success');
        return redirect('/makeupArtists')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/makeupArtists')->with('status','Data Not Updated');
        }
    }


    public function delete($id)
    {
        $makeupArtist = User::findOrFail($id);
        $makeupArtist ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }


    public function change($id)
    {
        $makeupArtist = User::find($id);
        if ($makeupArtist->status !== '1')
        {
            $makeupArtist->update(['status' => 1]);
        }
        else
        {
            $makeupArtist->update(['status' => 2]);
        }
        if($makeupArtist)
        {
            Session::flash('statuscode','success');
            return redirect('/makeupArtists')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/makeupArtists')->with('status','Data Not Updated');
        }
    }


    public function changeToAdmin($id)
    {
        $makeupArtist = User::findOrFail($id);
        if(! $makeupArtist)
        {
            return redirect()->back();
        }
        $makeupArtist->update(['role' => 'Admin']);
        if($makeupArtist)
        {
            Session::flash('statuscode','success');
            return redirect('/makeupArtists')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/makeupArtists')->with('status','Data Not Updated');
        }
    }


    public function changeToUser($id)
    {
        $makeupArtist = User::findOrFail($id);
        if(! $makeupArtist)
        {
            return redirect()->back();
        }
        $makeupArtist->update(['role' => 'User']);
        if($makeupArtist)
        {
            Session::flash('statuscode','success');
            return redirect('/makeupArtists')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/makeupArtists')->with('status','Data Not Updated');
        }
    }

    public function changeToMakeupArtist($id)
    {
        $makeupArtist = User::findOrFail($id);
        if(! $makeupArtist)
        {
            return redirect()->back();
        }
        $makeupArtist->update(['role' => 'MakeupArtist']);
        if($makeupArtist)
        {
            Session::flash('statuscode','success');
            return redirect('/makeupArtists')->with('status','Data Updated Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/makeupArtists')->with('status','Data Not Updated');
        }
    }
}
