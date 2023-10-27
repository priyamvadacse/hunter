@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Offers List
                        <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#usermodal">Add
                            Offers</a>
                    </div>
                </div>

            </div>
            <div class="card">
                <table class="table table-bordered table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Action</th>

                        </tr>

                    </thead>

                    @foreach ($data as $key => $off)
                        <tr>
                            <td>{{ ++$key }}</td>

                            <?php
                            $getofferdata = \app\Models\Admin\SubscriptionPackage::where('id', $off->package_id)->first();
                            ?>

                            <td>{{ $getofferdata->package }}</td>

                            <td>{{ $off->price }}</td>
                            <td>{{ $off->type == 'am' ? 'Amount' : 'Percentage' }}</td>
                            <td>{{ date('d-m-Y', strtotime($off->start_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($off->expire_date)) }}</td>
                            <td> <a data-id="{{ $off->id }}"
                                    class="btn btn-danger btn-sm delete_package zmdi zmdi-delete"></a>
                                <a href="#" class="btn btn-warning btn-sm edit_package zmdi zmdi-edit"
                                    data-package_id={{ $off->package_id }} data-id={{ $off->id }}
                                    data-type_name={{ $off->type }} data-value={{ $off->price }}
                                    data-start_date={{ $off->start_date }} data-expire={{ $off->expire_date }}></a>

                            </td>

                        </tr>
                    @endforeach

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add offer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="addPackage">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Package Name</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="name"
                                id="duration">
                                @foreach ($datapackeg as $item)
                                    <option value="{{ $item->id }}">{{ $item->package }}</option>
                                @endforeach
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="type_name"
                                id="type_duration">
                                <option value="">Select Type</option>
                                <option value="pr">percentage</option>
                                <option value="am">Amount</option>

                            </select>
                        </div>

                        <div class="form-group" id="per_value">
                            <label for="exampleInputEmail1">Discount value</label>
                            <input type="text" class="form-control" placeholder="Enter percentage" name="percentage">
                        </div>

                        <div class="form-group" id="price_value">
                            <label for="exampleInputEmail1">Discount price</label>
                            <input type="text" class="form-control" placeholder="Enter amount" name="pr_price">
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputEmail1">Start Date</label>
                            <input type="date" class="form-control" placeholder="Enter start date" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Expire Date</label>
                            <input type="date" class="form-control" name="Expire_date">
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



    <!--Edit Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update offer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="updatePackage">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Package Name</label>

                            <input type="hidden" class="form-control" placeholder="Enter Package Name" name="id"
                                id="edit_id">

                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="package_id"
                                id="edit_name">



                                @foreach ($datapackeg as $item)
                                    <option value="{{ $item->id }}">{{ $item->package }}</option>
                                @endforeach
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="type_name"
                                id="edit_types_duration">
                                <option value="">Select Type</option>
                                <option value="pr">percentage</option>
                                <option value="am">Amount</option>

                            </select>
                        </div>

                        <div class="form-group" id="edit_per_value">
                            <label for="exampleInputEmail1">Discount value</label>
                            <input type="text" class="form-control" placeholder="Enter percentage" id="per"
                                name="percent">
                        </div>

                        <div class="form-group" id="edit_price_value">
                            <label for="exampleInputEmail1">Discount price</label>
                            <input type="text" class="form-control" placeholder="Enter amount" id="amount"
                                name="price">
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Type</label>
                            <select class="form-control show-tick ms select2" data-placeholder="Select" name="type_name"
                                id="type_duration">

                                <option value="pr">percentage</option>
                                <option value="am">Amount</option>

                            </select>
                        </div> --}}

                        <div class="form-group">


                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Start date</label>
                            <input type="date" class="form-control" placeholder="Enter Monthly Price"
                                name="start_date" id="startdate">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Expire date</label>
                            <input type="date" class="form-control" name="expire" id="expire_date">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </section>
@section('extra_js')
    <script>
        $(function() {
            $("#per_value").hide();
            $("#price_value").hide();
            //alert('hello');
            $("body").on("click", ".delete_package", function(e) {

                e.preventDefault()

                let id = $(this).attr('data-id');
                // alert('l');
                let fd = new FormData();
                fd.append('id', id);
                fd.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    method: "POST",
                    url: "{{ route('admin.offerdelete') }}",
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
                    url: "{{ route('admin.offersave') }}",
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

            $("#edit_per_value").hide();
            $("#edit_price_value").hide();
            $("body").on("click", ".edit_package", function(e) {
                var package_id = $(this).data('package_id');

                var id = $(this).data('id');
                var type_name = $(this).data('type_name');

                var value = $(this).data('value');
                var start_date = $(this).data('start_date');
                var expire = $(this).data('expire');

                $("#edit_name").val(package_id);
                $('#edit_id').val(id);
                $('#edit_types_duration').val(type_name);
                $('#per').val(value);
                $('#amount').val(value);
                $('#startdate').val(start_date);
                $('#expire_date').val(expire);
                //alert(value)
                // $('#type').val(type);

                if (type_name === 'pr') {
                    $("#edit_per_value").show();
                    $("#edit_price_value").hide();
                    $('#edit_per_value').val(value);
                } else {
                    $("#edit_per_value").hide();
                    $("#edit_price_value").show();
                    $('#edit_price_value').val(value);
                }

                $('#editModal').modal('toggle')

            });


            $('.updatePackage').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.offerupdate') }}",
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

        $(document).ready(function() {
            $("#type_duration").change(function() {
                $valuetype = $(this).val();
                // alert($valuetype); 
                if ($valuetype == 'pr') {

                    $("#per_value").show();
                    $("#price_value").hide();

                } else {

                    $("#price_value").show();
                    $("#per_value").hide();
                }


            });
        });

        $(document).ready(function() {
            $("#edit_types_duration").change(function() {
                $valuetype = $(this).val();
                // alert($valuetype); 
                if ($valuetype == 'pr') {

                    $("#edit_per_value").show();
                    $("#edit_price_value").hide();

                } else {

                    $("#edit_price_value").show();
                    $("#edit_per_value").hide();
                }


            });
        });
    </script>
@endsection


@endsection
