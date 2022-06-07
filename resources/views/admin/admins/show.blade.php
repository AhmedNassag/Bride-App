@extends('layouts.master')


@section('title')
    Admin
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Admin
                        <a href="{{url('admin-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Role</th>
                                <th>City</th>
                                <th>Location</th>
                                <th>Email</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <input type="hidden" class="userDelBtn" value="{{$row->id}}">
                                    <td>1</td>
                                    <td>{{$row->name}}</td>
                                    <td><img src="{{asset('assets/img/avatar/'.$admin->avatar)}}" height="55px" width="55px"></td>
                                    <td>Admin</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <a href="{{url('admin-edit/'.$admin->id)}}" class="btn btn-info">EDIT</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger adminDeleteBtn">DELETE</button>
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
            $('.adminDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".adminDelBtn").val();
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
                            url : "/admin-delete/"+deleteId,
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
