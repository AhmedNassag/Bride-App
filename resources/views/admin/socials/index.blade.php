@extends('layouts.master')


@section('title')
    Socials
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Socials
                        <a href="{{url('social-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th class="text-center">#</th> -->
                                <th class="text-center">User</th>
                                <th class="text-center">Facebook</th>
                                <th class="text-center">Instgram</th>
                                <th class="text-center">Tiktok</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="text-overflow: hidden;">
                            @php $i=0; @endphp
                            @foreach($socials as $row)
                            @php $i++; @endphp
                            <tr>
                                <input type="hidden" class="socialDelBtn" value="{{$row->id}}">
                                <!-- <td class="text-center">{{$i}}</td> -->
                                <td class="text-center"><a href="{{url('social-show/'.$row->id)}}" style="color: #1f1f1f">{{$row->user->name}}</a></td>
                                <td class="text-center">{{$row->facebook}}</td>
                                <td class="text-center">{{$row->instgram}}</td>
                                <td class="text-center">{{$row->tiktok}}</td>
                                <td class="text-center">{{$row->website}}</td>
                                <td class="text-center">
                                    <a href="{{url('social-edit/'.$row->id)}}" class="btn btn-info btn-sm m-1">EDIT</a>
                                    <button type="button" class="btn btn-danger btn-sm socialDeleteBtn">DELETE</button>
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
            $('.socialDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".socialDelBtn").val();
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
                            url : "/social-delete/"+deleteId,
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
