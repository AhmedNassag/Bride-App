@extends('layouts.master')


@section('title')
    Dashboard
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Dashboard
                        <a href="{{url('user-create')}}" class="btn btn-primary float-right py-2">ADD</a>
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
                            @php $i=0; @endphp
                            @foreach($users as $row)
                            @php $i++; @endphp
                                <tr>
                                    <input type="hidden" class="userDelBtn" value="{{$row->id}}">
                                    <td>{{$i}}</td>
                                    <td>{{$row->name}}</td>
                                    <td><img src="{{asset('assets/img/avatar/'.$row->avatar)}}" height="55px" width="55px"></td>
                                    <td>
                                        <?php
                                            if($row->role == 0) {echo'Admin';}
                                            elseif($row->role == 1) {echo'Makeup Artist';}
                                            else {echo'User';}
                                        ?>
                                    </td>
                                    <td>{{$row->city_id}}</td>
                                    <td>{{$row->location_id}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <a href="{{url('user-edit/'.$row->id)}}" class="btn btn-info">EDIT</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger userDeleteBtn">DELETE</button>
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
