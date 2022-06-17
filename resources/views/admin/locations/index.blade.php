@extends('layouts.master')


@section('title')
    Locations
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Locations
                        <a href="{{url('location-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Area</th>
                                <th class="text-center">City</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($locations as $row)
                            @php $i++; @endphp
                            <tr>
                                <input type="hidden" class="locationDelBtn" value="{{$row->id}}">
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center"><a href="{{url('location-show/'.$row->id)}}" style="color: #1f1f1f">{{$row->address}}</a></td>
                                <td class="text-center">{{$row->city->name}}</td>
                                <td class="text-center">{{$row->area->name}}</td>
                                <td class="text-center">
                                    <a href="{{url('location-edit/'.$row->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    <button type="button" class="btn btn-danger btn-sm locationDeleteBtn">DELETE</button>
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
            $('.locationDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".locationDelBtn").val();
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
                            url : "/location-delete/"+deleteId,
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
