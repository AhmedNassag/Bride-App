@extends('layouts.master')


@section('title')
    Social
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                    Social
                        <a href="{{url('social-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Facebook</th>
                                <th class="text-center">Instgram</th>
                                <th class="text-center">Tiktok</th>
                                <th class="text-center">Website</th>
                                <!-- <th class="text-center">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <input type="hidden" class="socialDelBtn" value="{{$social->id}}">
                                    <td class="text-center">1</td>
                                    <td class="text-center">{{$user->name}}</td>
                                    <td class="text-center">{{$social->facebook}}</td>
                                    <td class="text-center">{{$social->instgram}}</td>
                                    <td class="text-center">{{$social->tiktok}}</td>
                                    <td class="text-center">{{$social->website}}</td>
                                    <!-- <td class="text-center">
                                        <a style="margin: 5px 0" href="{{url('social-edit/'.$social->id)}}" class="btn btn-sm btn-info">EDIT</a>
                                        <button type="button" class="btn btn-sm btn-danger socialDeleteBtn">DELETE</button>
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
