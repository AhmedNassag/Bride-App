@extends('layouts.master')


@section('title')
    About Us
@endsection


@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add About</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/save-aboutus" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Sub-Title:</label>
                            <input type="text" name="subtitle" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea name="description" class="form-control" id="message-text"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Start Delete Modal--}}
    <div class="modal fade" id="deleteModalPop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteModalForm" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-body">
                        <input type="hidden" id="deleteAboutusId">
                        <h5>Are You Sure..?? You Want To Delete This Data..!!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes, Delete It</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--End Delete Modal--}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        About Us
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead class=" text-primary">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Sub-Title</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($aboutus as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->subtitle}}</td>
                                    <td>
                                        <div style="height:80px; overflow:hidden">
                                            {{$row->description}}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{url('aboutus/'.$row->id)}}" class="btn btn-success">EDIT</a>
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a>
                                        {{--
                                        <form action="{{url('aboutus-delete/'.$row->id)}}" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                        --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function ()
        {
            $('#dataTable').DataTable();
            $('#dataTable').on('click','.deletebtn',function ()
            {
                $tr = $(this).closest('tr');
                var data = $tr.children('td').map(function ()
                {
                    return $(this).text();
                }).get();
                $('#deleteAboutusId').val(data[0]);
                $('#deleteModalForm').attr('action','/aboutus-delete/'+data[0]);
                $('#deleteModalPop').modal('show');
            });
        });
    </script>


    <script>
        $(document).ready(function()
        {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
