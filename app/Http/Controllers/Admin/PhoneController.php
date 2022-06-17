<?php

namespace App\Http\Controllers\Admin;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phone::all();
        $data   = [];
        foreach($phones as $phone)
        {
            $user = User::find($phone->user_id);
            $phone->name = $user;
            $data[] = $phone;
        }
        return view('admin.phones.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phone  = Phone::find($id);
        $user   = User::where('id',$phone->user_id)->first();
        return view('admin.phones.show',compact('phone','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.phones.create',compact('users'));
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
            'number'  => 'required|min:10',
            'user_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $phone = Phone::create
        ([
            'number'  => $request -> number,
            'user_id' => $request -> user_id,
        ]);

        if($phone)
        {
            Session::flash('statuscode','success');
            return redirect('/phones')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/phones')->with('status','Data Not Added');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $phone = Phone::find($id);
        return view('admin.phones.edit',compact('phone','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $phone = Phone::findOrFail($id);
        if(! $phone)
        {
            return redirect()->back();
        }
        $validator = Validator::make($request->all(),
        [
            'number'  => 'required|min:10',
            'user_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $phone -> update
        ([
            'number'  => $request -> number,
            'user_id' => $request -> user_id,
        ]);

        if($phone)
        {
            Session::flash('statuscode','success');
            return redirect('/phones')->with('status','Data Added Successfully');
        }
        else
        {
            Session::flash('statuscode','error');
            return redirect('/phones')->with('status','Data Not Added');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $phone = Phone::findOrFail($id);
        $phone ->delete();
        return response()->json(['status' => 'Data Deleted Successfully']);
    }
}
