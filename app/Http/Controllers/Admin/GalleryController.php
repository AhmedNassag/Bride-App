<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.galleries.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        $users    = User::all();
        return view('admin.galleries.create',compact('packages','users'));
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
            'image'      => 'required|image|mimes:png,jpeg,jpg',
            'package_id' => 'required',
            'user_id'    => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name      = time().'.'.$file_extension;
        $path           = 'gallery';
        $request->image->move($path,$file_name);
        $gallery = Gallery::create
        ([
            'image'      => $file_name,
            'package_id' => $request -> package_id,
            'user_id'    => $request -> user_id,
        ]);
        if($gallery)
        {
            Session::flash('statuscode','success');
            return redirect('/galleries')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/galleries')->with('status','Data Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        $package = Package::find($gallery->package_id);
        $user    = User::find($gallery->user_id);
        return view('admin.galleries.show',compact('gallery','package','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery  = Gallery::find($id);
        $packages = Package::all();
        $users    = User::all();
        return view('admin.galleries.edit',compact('gallery','packages','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        if(! $gallery)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'image'      => 'sometimes|nullable|image|mimes:png,jpeg,jpg',
            'package_id' => 'required',
            'user_id'    => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file_name = $gallery->image;
        if($request->file('image'))
        {
            $file_extension = $request->image->getClientOriginalExtension();
            $file_name      = time().'.'.$file_extension;
            $path           = 'gallery';
            $request->image->move($path,$file_name);
        }
        $gallery -> update
        ([
            'image'      => $file_name,
            'package_id' => $request -> package_id,
            'user_id'    => $request -> user_id,
        ]);
        if($gallery)
        {
        Session::flash('statuscode','success');
        return redirect('/galleries')->with('status','Data Updated Successfully');
        }
        else
        {
        Session::flash('statuscode','error');
        return redirect('/galleries')->with('status','Data Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
