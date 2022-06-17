@extends('layouts.master')


@section('title')
    Galleries
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                    Galleries
                        <a href="{{url('gallery-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="text-overflow: hidden;">
                            @php $i=0; @endphp
                            @foreach($galleries as $row)
                            @php $i++; @endphp
                            <tr>
                                <input type="hidden" class="galleryDelBtn" value="{{$row->id}}">
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center"><a href="{{url('gallery-show/'.$row->id)}}"><img src="{{asset('gallery/'.$row->image)}}" style="width:100px; height:100px;"></a></td>
                                <td class="text-center">
                                    <a href="{{url('gallery-edit/'.$row->id)}}" class="btn btn-info btn-sm m-1">EDIT</a>
                                    <button type="button" class="btn btn-danger btn-sm galleryDeleteBtn">DELETE</button>
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
            $('.galleryDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".galleryDelBtn").val();
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
                            url : "/gallery-delete/"+deleteId,
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
