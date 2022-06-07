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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>Location</th>
                                <th>Role</th>
                                <th>Avatar</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($admins as $row)
                            @php $i++; @endphp
                                <tr>
                                    <input type="hidden" class="adminDelBtn" value="{{$row->id}}">
                                    <td>{{$i}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>
                                        <?php
                                            if($row->role == 0) {echo'Admin';}
                                            elseif($row->role == 1) {echo'Makeup Artist';}
                                            else {echo'User';}
                                        ?>
                                    </td>
                                    <td>{{$row->city}}</td>
                                    <td>{{$row->location}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <a href="{{url('admin-edit/'.$row->id)}}" class="btn btn-info">EDIT</a>
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
