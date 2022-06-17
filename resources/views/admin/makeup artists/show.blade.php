@extends('layouts.master')


@section('title')
    makeupArtist
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        makeupArtist
                        <a href="{{url('makeupArtist-create')}}" class="btn btn-primary float-right py-2">ADD</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Social</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Packages</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <input type="hidden" class="userDelBtn" value="{{$makeupArtist->id}}">
                                    <td class="text-center">
                                        <img src="{{asset('avatar/'.$makeupArtist->avatar)}}" height="55px" width="55px">
                                    </td>
                                    <td class="text-center">{{$makeupArtist->name}}</td>
                                    <td class="text-center">{{$makeupArtist->email}}</td>
                                    <td class="text-center">
                                        @if($phones)
                                            @foreach($phones as $phone)
                                            <ul>
                                                <li>{{$phone->number}}</li>
                                            </ul>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($social)
                                        <ul>
                                            <li>{{$social->facebook}}</li>
                                            <li>{{$social->instgram}}</li>
                                            <li>{{$social->tiktok}}</li>
                                            <li>{{$social->website}}</li>
                                        </ul>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($locations)
                                            @foreach($locations as $location)
                                            <ul>
                                                <li>{{$location->address}}, {{$location->area->name}}, {{$location->city->name}}</li>
                                            </ul>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($packages)
                                            @foreach($packages as $package)
                                            <ul>
                                                <li><a href="{{url('package-show/'.$package->id)}}" style="color: #1f1f1f">{{$package->name}}</a></li>
                                            </ul>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">
                                    @if($makeupArtist->status == 1)
                                    <a href="{{url('makeupArtist-change/'.$makeupArtist->id)}}" class="btn btn-adn btn-sm"><i class="fa fa-times-circle"></i>Block</a>
                                    @else
                                    <a href="{{url('makeupArtist-change/'.$makeupArtist->id)}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i>Active</a>
                                    @endif
                                        <!-- <a style="margin: 5px 0" href="{{url('makeupArtist-edit/'.$makeupArtist->id)}}" class="btn btn-sm btn-info">EDIT</a>
                                        <button type="button" class="btn btn-sm btn-danger makeupArtistDeleteBtn">DELETE</button> -->
                                    </td>
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
            $('.makeupArtistDeleteBtn').click(function(e)
            {
                e.preventDefault();
                var deleteId = $(this).closest("tr").find(".makeupArtistDelBtn").val();
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
                            url : "/makeupArtist-delete/"+deleteId,
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
