@extends('layouts.master')


@section('title')
    Makeup Artist
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Admins
                        <a href="{{url('makeupArtists')}}" class="btn btn-danger float-right py-2">BACK</a>
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
                    <form action="{{url('makeupArtist-update/'.$makeupArtist->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$makeupArtist->name}}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{$makeupArtist->email}}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{$makeupArtist->password}}">
                                </div>
                            </div>

                            <!-- select -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="Admin">Admin</option>
                                        <option value="Makeup Artist">Makeup Artist</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Avatar</label>
                                <input type="file" name="avatar" class="form-control">
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
