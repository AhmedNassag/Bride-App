@extends('layouts.master')


@section('title')
    Phones
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Phone
                        <a href="{{url('phone-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($data as $row)
                            @php $i++; @endphp
                            <tr>
                                <input type="hidden" class="phoneDelBtn" value="{{$row->id}}">
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center"><a href="{{url('phone-show/'.$row->id)}}" style="color: #1f1f1f">{{$row->number}}</a></td>
                                <td class="text-center">{{$row->name->name}}</td>
                                <td class="text-center">
                                    <a href="{{url('phone-edit/'.$row->id)}}" class="btn btn-info btn-sm">EDIT</a>
                                    <button type="button" class="btn btn-danger btn-sm phoneDeleteBtn">DELETE</button>
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
            $('.phoneDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".phoneDelBtn").val();
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
                            url : "/phone-delete/"+deleteId,
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
