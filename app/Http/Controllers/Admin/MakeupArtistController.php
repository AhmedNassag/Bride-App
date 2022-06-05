<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class MakeupArtistController extends Controller
{
    public function index()
    {
        $makeupArtists = User::where('role',1)->get();
        return view('admin.makeupArtists.index')->with('makeupArtists',$makeupArtists);
    }

    public function create()
    {
        return view('admin.makeupArtists.create');
    }


    public function store(Request $request)
    {
        $makeupArtist = User::create
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => encrypt($request -> password),
        ]);
        if($makeupArtist)
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
        $makeupArtist = User::find($id);
        return view('admin.makeupArtists.edit')->with('makeupArtist',$makeupArtists);
    }


    public function update(Request $request, $id)
    {
        $makeupArtist = User::findOrFail($id);
        if(! $makeupArtists)
        {
            return redirect()->back();
        }
        $makeupArtist -> update
        ([
            'name'     => $request -> name,
            'phone'    => $request -> phone,
            'role'     => $request -> role,
            'city'     => $request -> city,
            'location' => $request -> location,
            'email'    => $request -> email,
            'password' => $request -> password,
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
}
