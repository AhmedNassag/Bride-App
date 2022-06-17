@extends('layouts.master')


@section('title')
    City
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        City
                        <a href="{{url('city-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Locations</th>
                                <!-- <th class="text-center">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <input type="hidden" class="cityDelBtn" value="{{$city->id}}">
                                    <td class="text-center">{{$city->name}}</td>
                                    <td class="text-center">
                                        @foreach($locations as $row)
                                            <li>{{$row->address}}</li>
                                        @endforeach
                                    </td>
                                    <!-- <td class="text-center">
                                        <a style="margin: 5px 0" href="{{url('city-edit/'.$city->id)}}" class="btn btn-sm btn-info">EDIT</a>
                                        <button type="button" class="btn btn-sm btn-danger cityDeleteBtn">DELETE</button>
                                    </td> -->
                                </tr>
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
            $('.cityDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".cityDelBtn").val();
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
                            url : "/city-delete/"+deleteId,
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
