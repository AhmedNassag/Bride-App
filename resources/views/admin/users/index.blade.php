@extends('layouts.master')


@section('title')
    Users
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Users
                        <a href="{{url('user-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Change To</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($users as $row)
                            @php $i++; @endphp
                            <tr>
                                <input type="hidden" class="userDelBtn" value="{{$row->id}}">
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center">
                                    <img src="{{asset('avatar/'.$row->avatar)}}" alt="image"  style="border-radius:10px; border-style:dot-dot-dash; width:60px; height:60px">
                                </td>
                                <td class="text-center"><a href="{{url('user-show/'.$row->id)}}" style="color: #1f1f1f">{{$row->name}}</a></td>
                                <td class="text-center">{{$row->email}}</td>
                                <td class="text-center">{{$row->role}}</td>
                                <td class="text-center">
                                    @if($row->role == 'Admin')
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-makeupArtist/'.$row->id)}}" class="dropdown-item btn btn-sm btn-warning"><i class="fa fa-female"></i> Makeup Artist</a>
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-user/'.$row->id)}}" class="dropdown-item btn btn-sm btn-info"><i class="fa fa-user"></i> User</a>
                                        </div>
                                    </div>
                                    @elseif($row->role == 'MakeupArtist')
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-admin/'.$row->id)}}" class="dropdown-item btn btn-sm btn-success"><i class="fa fa-user-secret"></i> Admin</a>
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-user/'.$row->id)}}" class="dropdown-item btn btn-sm btn-info"><i class="fa fa-user"></i> User</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-admin/'.$row->id)}}" class="dropdown-item btn btn-sm btn-success"><i class="fa fa-user-secret"></i> Admin</a>
                                            <a style="margin: 5px 0" href="{{url('admin-changeTo-makeupArtist/'.$row->id)}}" class="dropdown-item btn btn-sm btn-warning"><i class="fa fa-female"></i> Makeup Artist</a>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($row->status == 0)
                                    <span class="label-default" style="color:aliceblue; background-color:dimgray">UnActive</span>
                                    @elseif($row->status == 1)
                                    <span class="label-success" style="color:aliceblue; background-color:limegreen">Active</span>
                                    @else($row->status == 3)
                                    <span class="label-danger" style="color:aliceblue; background-color:red">Blocked</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{url('user-edit/'.$row->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    <button type="button" class="btn btn-danger btn-sm adminDeleteBtn">DELETE</button>
                                    @if($row->status == 1)
                                    <a style="margin: 5px 0" href="{{url('user-change/'.$row->id)}}" class="btn btn-adn btn-sm"><i class="fa fa-times-circle"></i>Block</a>
                                    @else
                                    <a style="margin: 5px 0" href="{{url('user-change/'.$row->id)}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i>Active</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function ()
        {
            $('.userDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".userDelBtn").val();
                swal
                ({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) =>
                {
                    if (willDelete)
                    {
                        var data =
                        {
                            "_token": $('input[name= _token]').val(),
                            "id"    : deleteId,
                        };
                        $.ajax({
                            type: "DELETE",
                            url : "/user-delete/"+deleteId,
                            data: data,
                            success: function (response)
                            {
                                swal(response.status,
                                {
                                    icon: "success",
                                })
                                .then((result) =>
                                {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
