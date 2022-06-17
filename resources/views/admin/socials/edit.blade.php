@extends('layouts.master')


@section('title')
    Socials
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Socials
                        <a href="{{url('socials')}}" class="btn btn-danger float-right py-2">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="alert alert-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session()->get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{url('social-update/'.$social->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" placeholder="Enter Facebook" value="{{$social->facebook}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Instgram</label>
                                    <input type="text" name="instgram" class="form-control" placeholder="Enter Instgram" value="{{$social->instgram}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tiktok</label>
                                    <input type="text" name="tiktok" class="form-control" placeholder="Enter Tiktok" value="{{$social->tiktok}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" placeholder="Enter Website" value="{{$social->website}}">
                                </div>
                            </div>

                            <!-- select -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Users</label>
                                    <select name="user_id" class="form-control">
                                        @foreach($users as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-success">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
