<?php

namespace App\Http\Controllers\Admin;

use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::all();
        return view('admin.socials.index',compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::all();
        return view('admin.socials.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'facebook' => 'required|string|max:255',
            'instgram' => 'required|string|max:255',
            'tiktok'   => 'required|string|max:255',
            'website'  => 'required|string|max:255',
            'user_id'  => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $social = Social::create
        ([
            'facebook' => $request -> facebook,
            'instgram' => $request -> instgram,
            'tiktok'   => $request -> tiktok,
            'website'  => $request -> website,
            'user_id'  => $request -> user_id,
        ]);
        if($social)
        {
            Session::flash('statuscode','success');
            return redirect('/socials')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/socials')->with('status','Data Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social = Social::find($id);
        $user   = User::find($social->user_id);
        return view('admin.socials.show',compact('social','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social = Social::find($id);
        $users  = User::all();
        return view('admin.socials.edit',compact('social','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $social = Social::findOrFail($id);
        if(! $social)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'facebook' => 'required|string|max:255',
            'instgram' => 'required',
            'tiktok'   => 'required',
            'website'  => 'required',
            'user_id'   => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $social -> update
        ([
            'facebook' => $request -> facebook,
            'instgram' => $request -> instgram,
            'tiktok'   => $request -> tiktok,
            'website'  => $request -> website,
            'user_id'  => $request -> user_id,
        ]);
        if($social)
        {
            Session::flash('statuscode','success');
            return redirect('/socials')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/socials')->with('status','Data Not Added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $social = Social::findOrFail($id);
        $social ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
