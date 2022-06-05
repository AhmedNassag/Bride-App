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
                        Makeup Artists
                        <a href="{{url('makeupArtist')}}" class="btn btn-danger float-right py-2">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('makeupArtist-store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>

                            <!-- select -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="0">Admin</option>
                                        <option value="1">Makeup Artist</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" class="form-control">
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="location_id" class="form-control">
                                        @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>';
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
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
