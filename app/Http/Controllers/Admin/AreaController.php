<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.areas.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.areas.create');
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
            'name'     => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $area = Area::create
        ([
            'name'     => $request -> name,
        ]);

        if($area)
        {
            Session::flash('statuscode','success');
            return redirect('/areas')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/areas')->with('status','Data Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area      = Area::find($id);
        $locations = Location::where('area_id',$area->id)->get();
        return view('admin.areas.show',compact('area','locations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find($id);
        return view('admin.areas.edit',compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        if(! $area)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $area -> update
        ([
            'name' => $request -> name,
        ]);
        if($area)
        {
        Session::flash('statuscode','success');
        return redirect('/areas')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/areas')->with('status','Data Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $area = Area::findOrFail($id);
        $area ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
