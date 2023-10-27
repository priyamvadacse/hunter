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
                            <h3 style="color: #df3269;" class="mb-2"> Story List</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.add_story_pages') }}"
                                class="btn btn-sm btn-primary text-white float-right ">Add Story</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" id="user_list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Pic</th>
                                    {{-- <th scope="col">Description</th> --}}
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

    </section>

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
            $('#user_list').DataTable({
                "processing": true,
                pageLength: 10,
                "serverSide": true,
                "ajax": {
                    url: "{{ route('admin.story_list_ajax') }}",
                    "type": "GET",
                    "data": function(d) {
                        d.token = "{{ csrf_token() }}";
                    },
                    dataFilter: function(data) {
                        var json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data;
                        return JSON.stringify(json);
                    }

                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "target": 0,
                        "name": 'id',
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "target": 1,
                        "name": 'title',
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "target": 2,
                        "name": 'image',
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "target": 3,
                        "name": 'status',
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "target": 4,
                        "name": 'action',
                        "searchable": false,
                        "orderable": false
                    },
                ]

            });



            //  method use for delete story
            $("body").on("click", ".delete_story", function(e) {

                e.preventDefault()

                let id = $(this).attr('data-id');

                let fd = new FormData();
                fd.append('id', id);
                fd.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.delete_story') }}",
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

            // method use for update status
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
                                    url: "{{ route('admin.update_status_story') }}",
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
                                        $('#user_list').DataTable().ajax.reload(null,
                                        false);

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

        });
    </script>
@endsection
