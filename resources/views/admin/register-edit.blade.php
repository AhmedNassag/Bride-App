@extends('layouts.master')


@section('title')
    Edit Register Roles
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Role For Registered</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="/role-update/{{$users->id}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('Put')}}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="username" class="form-control" value="{{$users->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Give Role</label>
                                        <select name="usertype" class="form-control">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                            <option value="">Null</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="/role-register" class="btn btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
