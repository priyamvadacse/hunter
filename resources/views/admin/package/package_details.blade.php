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
                        Package Details List
                        <a href="{{route('admin.add_package.details')}}" class="btn btn-sm btn-primary text-white">Add
                            Package Details</a>
                    </div>
                </div>

            </div>
            <div class="card">
                <table class="table table-bordered table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Package Duration</th>
                            <th scope="col">Monthly Price</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @foreach ($package as $key => $p)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $p->subscription_package->package }}</td>
                            <td>{{ $p->package_duration/30 }}</td>
                            <td>{{ $p->package_duration == 30 ? $p->price : ($p->package_duration == 180 ? $p->price/6 :  $p->price/12) }}</td>
                            <td>{{ $p->price}}</td>
                            <td> <a data-id="{{ $p->id }}" class="btn btn-danger btn-sm delete_package">Delete</a>
                                <a href="#" class="btn btn-warning btn-sm edit_package" data-name={{ $p->package }}
                                    data-id={{ $p->id }}>Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>



@section('extra_js')
    {{-- <script>
        $(function() {
            // alert('hello');
            $("body").on("click", ".delete_package", function(e) {

                e.preventDefault()

                let id = $(this).attr('data-id');
                // alert('l');
                let fd = new FormData();
                fd.append('id', id);
                fd.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.delete.package') }}",
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

            $('.addPackage').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.add.package') }}",
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


            $("body").on("click", ".edit_package", function(e) {
                var name = $(this).data('name');
                var id = $(this).data('id');
                $("#edit_name").val(name)
                $('#edit_id').val(id);
                $('#editModal').modal('toggle')
            });


            $('.updatePackage').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.update.package') }}",
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



        });
    </script> --}}
@endsection
@endsection
