<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index',compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $areas  = Area::all();
        $users  = User::all();
        return view('admin.locations.create',compact('cities','areas','users'));
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
            'address' => 'required|string|max:255',
            'city_id' => 'required',
            'area_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $location = Location::create
        ([
            'address' => $request -> address,
            'city_id' => $request -> city_id,
            'area_id' => $request -> area_id,
            'user_id' => $request -> user_id,
        ]);
        if($location)
        {
            Session::flash('statuscode','success');
            return redirect('/locations')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/locations')->with('status','Data Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        $area     = Area::find($location->area_id);
        $city     = City::where($location->city_id);
        return view('admin.locations.show',compact('location','area','city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        $areas    = Area::all();
        $cities   = City::all();
        $users    = User::all();
        return view('admin.locations.edit',compact('location','areas','cities','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        if(! $location)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'address' => 'required|string|max:255',
            'city_id' => 'required',
            'area_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $location -> update
        ([
            'address' => $request -> address,
            'city_id' => $request -> city_id,
            'area_id' => $request -> area_id,
            'user_id' => $request -> user_id,
        ]);
        if($location)
        {
            Session::flash('statuscode','success');
            return redirect('/locations')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/locations')->with('status','Data Not Added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $location = Location::findOrFail($id);
        $location ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
