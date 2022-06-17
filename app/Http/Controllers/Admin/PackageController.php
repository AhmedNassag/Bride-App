<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Social;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::all();
        return view('admin.packages.create',compact('users'));
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
            'name'    => 'required|string|max:255',
            'details' => 'required|string',
            'price'   => 'required|string|max:255',
            'user_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $package = Package::create
        ([
            'name'    => $request -> name,
            'details' => $request -> details,
            'price'   => $request -> price,
            'user_id' => $request -> user_id,
        ]);
        if($package)
        {
            Session::flash('statuscode','success');
            return redirect('/packages')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/packages')->with('status','Data Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        $user    = User::find($package->user_id);
        return view('admin.areas.show',compact('package','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        $users   = User::all();
        return view('admin.packages.edit',compact('package','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        if(! $package)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'name'    => 'required|string|max:255',
            'details' => 'required',
            'price'   => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $package -> update
        ([
            'name'    => $request -> name,
            'details' => $request -> details,
            'price'   => $request -> price,
            'user_id' => $request -> user_id,
        ]);
        if($package)
        {
        Session::flash('statuscode','success');
        return redirect('/packages')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/packages')->with('status','Data Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $package = Package::findOrFail($id);
        $package ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
