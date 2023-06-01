@extends('admin.layout.layouts')
@section('extra_css')

@endsection

@section('content')
    <section class="content" style="background:none;">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div class="">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3" style="color:#d51c57 ">Active User List</h3>
                        {{-- <a href="{{ route('admin.user') }}" class="btn btn-sm btn-primary">Add User</a> --}}
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable" id="user_list">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Pic</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Interested In</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($users as $key => $u)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td><img src="{{ url($u->pic1) }}" alt="" width="70px;"></td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->gender }}</td>
                                    <td>{{ $u->interested_in }}</td>
                                    <td>{{ $u->status }}</td>
                                    <td> <a  data-id="{{ $u->id }}"
                                            class="btn btn-danger btn-sm delete_user">Delete</a>
                                        <a href="{{url('admin/edit-user/'.$u->id)}}"
                                            class="btn btn-warning btn-sm edit_user">Edit</a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @endsection

@section('libraries')
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection

@section('extra_js')

    <script>
        $(function() {
            // alert('hello');
            $("body").on("click", ".delete_user", function(e) {

                e.preventDefault()

                let id = $(this).attr('data-id');
                // alert('l');
                let fd = new FormData();
                fd.append('id', id);
                fd.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.user.delete') }}",
                    data: fd,
                    dataType: "JSON",
                    contentType: false,
                    processData: false,
                    success: function(result) {

                        if (result.status) {
                            iziToast.success({
                                title: '',
                                message: result.msg,
                                position: 'topRight'
                            });
                            setTimeout(function() {
                                window.location.reload()
                            }, 2000);

                        } else {
                            iziToast.error({
                                title: '',
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    }
                })
            })




            // datatable:
            $('#user_list').DataTable(
            {
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                "processing": true,
                pageLength: 10,
                "serverSide": true,
                "ajax": {
                    url: "{{route('admin.active_user.list.ajax')}}",
                    dataFilter: function (data) {
                        var json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data;
                        return JSON.stringify(json); // return JSON string
                    }
                },
                'columnDefs': [{
                    'targets': 0,
                    'name':'id',
                    'searchable': false,
                    'orderable': false,
                },
                    {"targets": 1, "name": "first_name", 'searchable': true, 'orderable': true},
                    {"targets": 2, "name": "last_name", 'searchable': true, 'orderable': false},
                    {"targets": 3, "name": "name", 'searchable': false, 'orderable': true},
                    {"targets": 4, "name": "name", 'searchable': false, 'orderable': true},
                    {"targets": 5, "name": "mane", 'searchable': false, 'orderable': true},
                    {"targets": 6, "name": "name", 'searchable': false, 'orderable': false},
                    {"targets": 7, "name": "name", 'searchable': false, 'orderable': false},
                    {"targets": 8, "name": "name", 'searchable': false, 'orderable': false},
                    {"targets": 9, "name": "name", 'searchable': false, 'orderable': false},
                ],
                'order': [[1, 'desc']],
            });


        });


        $("body").on("click", ".statusVerifiedClick", function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var status = $(this).data('status');
            let fd = new FormData()
            fd.append('_token', "{{ csrf_token() }}");
            fd.append('status', status);
            fd.append('id', id);
            $.confirm({
                title: 'Confirm!',
                content: 'Sure you want to change user status?',
                buttons: {
                    yes: function () {
                        $.ajax({
                            url: "{{ route('admin.user.status') }}",
                            type: 'POST',
                            data: fd,
                            dataType: "JSON",
                            contentType: false,
                            processData: false,
                        })
                            .done(function (result) {
                                if (result.status) {
                                    iziToast.success({
                                        title: '',
                                        message: result.msg,
                                        position: 'topRight'
                                    });
                                    $('#user_list').DataTable().ajax.reload(null, false);

                                } else {
                                    iziToast.error({
                                        title: '',
                                        message: result.msg,
                                        position: 'topRight'
                                    });
                                }
                            })
                            .fail(function (jqXHR, exception) {
                                console.log(jqXHR.responseText);
                            })


                    },
                    no: function () {
                    },
                }
            })
        })
    </script>

@endsection
