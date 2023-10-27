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
                        <div>
                            <h3 style="color: #df3269;" class="mb-2"> User List</h3>
                        </div>
                        <div>
                            {{-- <a href="{{ route('admin.user') }}" class="btn btn-sm btn-primary">Add User</a> --}}
                            <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#usermodal">CSV
                                Import</a>
                            
                            {{-- <span data-href="{{ route('admin.csvexport') }}" id="export" class="btn btn-primary btn-sm"
                                onclick="exportTasks(event.target);">CSV Export</span>                                 --}}

                        </div>
                    </div>
                    <div>
                        <form action="{{ route('admin.csvexport') }}", method="POST">
                            <button  id="export" type="submit" class="btn btn-success btn-sm float-right mx-4 " onclick="exportTasks(event.target);">Export</button>
                            <input type="hidden" id="searchType" name="value">
                            @csrf
                            From:
                            <input type="date"  id="start_date" name="start_date">
                            To:
                            <input type="date" id="end_date" name="end_date"> 
                           <button type="submit" class="btn btn-primary btn-sm" id="filter_date">Submit</button>
                        </form>
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
                                    <th scope="col">Create Date</th>

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

    </section>
    <!-- Button trigger modal -->
    <!--Csv Modal -->
    <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CSV Bulk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="csvupload" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="col-6"> --}}

                        {{-- </div> --}}
                        <strong>Should Be In The CSV File </strong><br>
                        <span class="form-group text-warning ">( First Name, Last Name, Email, Phone, DOB, Gender, Interested In, Interested Min Age, Interested Max Age, ) </span>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Csv Bluk</label>
                            <input type="file" class="form-control " name="file_csv">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('libraries')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
@endsection

@section('extra_js')
    <script>
        $(function() {
            const dt = $('#user_list').DataTable({
                "processing": true,
                pageLength: 10,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('admin.user.list_ajax') }}",
                    data: function(d){
                        d.from_date = $('#start_date').val()
                        d.end_date = $('#end_date').val()
                    },
                    dataFilter: function(data) {
                        var json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data;
                        return JSON.stringify(json); // return JSON string
                    }
                },
                'columnDefs': [{
                        'targets': 0,
                        'searchable': false,
                        'orderable': false,

                    },
                    {
                        "targets": 1,
                        "name": "first_name",
                        'searchable': true,
                        'orderable': true
                    },
                    {
                        "targets": 2,
                        "name": "last_name",
                        'searchable': true,
                        'orderable': false
                    },
                    {
                        "targets": 3,
                        "name": "name",
                        'searchable': false,
                        'orderable': true
                    },
                    {
                        "targets": 4,
                        "name": "name",
                        'searchable': false,
                        'orderable': true
                    },
                    {
                        "targets": 5,
                        "name": "mane",
                        'searchable': false,
                        'orderable': true
                    },
                    {
                        "targets": 6,
                        "name": "name",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 7,
                        "name": "name",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 8,
                        "name": "name",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 9,
                        "name": "name",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 10,
                        "name": "name",
                        'searchable': false,
                        'orderable': false
                    },
                ],
                'order': [
                    [1, 'desc']
                ],
            });

            $('#filter_date').click(function(e) {
                e.preventDefault();
                dt.ajax.reload();
                $('#filter_date')[0].reset();
            })


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
            

        });


        $("body").on("click", ".statusVerifiedClick", function(e) {

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
                    yes: function() {
                        $.ajax({
                                url: "{{ route('admin.user.status') }}",
                                type: 'POST',
                                data: fd,
                                dataType: "JSON",
                                contentType: false,
                                processData: false,
                            })
                            .done(function(result) {
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
                            .fail(function(jqXHR, exception) {
                                console.log(jqXHR.responseText);
                            })


                    },
                    no: function() {},
                }
            })
        })

        $('.csvupload').on('submit', function(e) {
            e.preventDefault()

            let fd = new FormData(this)
            fd.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('admin.csvpage') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#login-button').prop('disabled', true);
                    $('.loader').show();
                },
                success: function(result) {
                    if (result.status) {
                        iziToast.success({
                            title: '',
                            message: result.msg,
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            window.location.href = result.location;
                        }, 500);
                    } else {
                        iziToast.error({
                            title: '',
                            message: result.msg,
                            position: 'topRight'
                        });
                    }
                },
                complete: function() {
                    $('.loader').hide();
                },
                error: function(jqXHR, exception) {
                    $('.loader').hide();
                    console.log(jqXHR.responseText);
                }
            });
        })

        function exportTasks(target) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the values for the start_date and end_date inputs
            // var startDate = document.getElementById('start_date').value;
            // var endDate = document.getElementById('end_date').value;

            // // Assign the values to the hidden input field "value"
            // document.getElementById('searchType').value = startDate + ' to ' + endDate;

            // Submit the form
            target.closest('form').submit();
        }

        // function exportTasks(_this) {
        //     let _url = $(_this).data('href');
        //     window.location.href = _url;
        // }
    </script>
@endsection
