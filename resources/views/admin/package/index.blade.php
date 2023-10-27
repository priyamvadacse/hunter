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
                        Package List
                        <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#usermodal">Add
                            Package</a>
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
                            {{-- <th scope="col">Price</th> --}}
                            <th scope="col">Like</th>
                            <th scope="col">Boost</th>
                            {{-- <th scope="col">Image</th> --}}
                            <th scope="col">Action</th>

                        </tr>

                    </thead>
                    @foreach ($package as $key => $p)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $p->package }}</td>
                            <td>{{ $p->duration }} Months</td>
                            @php
                                $today = date('Y-m-d');
                                $getofferdata = \App\Models\Offer::where('package_id', $p->id)->first();
                            @endphp

                            @if (isset($getofferdata->expire_date))
                                @if ($today <= $getofferdata->expire_date)
                                    @if ($getofferdata)
                                        <td><del> {{ $p->monthly_price }}</del>
                                            {{ $getofferdata->type == 'am' ? $p->monthly_price - $getofferdata->price : $p->monthly_price - ($p->monthly_price * $getofferdata->price) / 100 }}
                                            {{-- {{ $p->monthly_price - $getofferdata->price }} --}}
                                        </td>
                                    @else
                                        <td> {{ $p->monthly_price }}</td>
                                    @endif
                                @else
                                    <td>{{ $p->monthly_price }}</td>
                                @endif
                            @else
                                <td>{{ $p->monthly_price }}</td>
                            @endif

                            {{-- @if (isset($getofferdata->price))
                                <td>{{ $p->duration * ($p->monthly_price - $getofferdata->price) }}</td>
                            @else
                                <td>{{ $p->duration * $p->monthly_price }}</td>
                            @endif --}}

                            <td>{{ $p->like }}</td>
                            <td>{{ $p->boost }}</td>
                            {{-- <td>
                                <img src="{{ asset($p->image) }}" alt="" width="70px">
                                {{$p->image}}
                            </td> --}}
                            <td> <a data-id="{{ $p->id }}"
                                    class="btn btn-danger btn-sm delete_package zmdi zmdi-delete"></a>
                                <a href="#" class="btn btn-warning btn-sm edit_package zmdi zmdi-edit"
                                    data-name={{ $p->package }} data-id={{ $p->id }}
                                    data-price={{ $p->monthly_price }} data-duration={{ $p->duration }}
                                    data-type={{ $p->type }} data-like={{ $p->like }}
                                    data-boost={{ $p->boost }}></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="addPackage" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="col-6"> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Package Name" name="package">
                        </div>
                        {{-- </div> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Package Duration</label>

                            <input type="text" class="form-control" placeholder="Enter month" name="duration">
                            {{-- <select class="form-control show-tick ms select2" data-placeholder="Select" name="duration">
                                <option value="90">3 Month</option>
                                <option value="180">6 Month</option>
                                <option value="270">9 Month</option>
                                <option value="360">12 Month</option>
                            </select> --}}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" class="form-control" placeholder="Enter Monthly Price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Like</label>
                            <input type="text" class="form-control" placeholder="Enter like" name="like">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Boost</label>
                            <input type="number" class="form-control" placeholder="Enter like" name="boost">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="type">
                            <label class="form-check-label" for="exampleCheck1">Set this as base package</label>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div> --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Update Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" class="updatePackage">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="col-6"> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Package Name</label>
                            <input type="text" class="form-control" placeholder="Enter Package Name" id="edit_name"
                                name="package">
                            <input type="hidden" class="form-control" placeholder="Enter Package Name" id="edit_id"
                                name="id">
                        </div>
                        {{-- </div> --}}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Package Duration</label>
                            <input type="text" class="form-control" placeholder="Enter month name" name="duration"
                                id="duration">
                            {{-- <select class="form-control show-tick ms select2" data-placeholder="Select" name="duration"
                                id="duration">
                                <option value="90">3 Month</option>
                                <option value="180">6 Month</option>
                                <option value="270">9 Month</option>
                                <option value="360">12 Month</option>
                            </select> --}}
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Monthly Price</label>
                            <input type="text" class="form-control" placeholder="Enter Monthly Price" name="price"
                                id="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Like</label>
                            <input type="text" class="form-control" placeholder="Enter like" name="like_edit"
                                id="like_id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Boost</label>
                            <input type="number" class="form-control" placeholder="Enter like" name="boost_edit"
                                id="boost_id">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="package_checkbox" name="type">
                            <label class="form-check-label" for="exampleCheck1">Set this as base package</label>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" class="form-control" placeholder="Enter Monthly Price" name="price" id="price">
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('extra_js')
    <script>
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
                var price = $(this).data('price');
                var duration = $(this).data('duration');
                var like = $(this).data('like')
                var boost = $(this).data('boost')
                var type = $(this).data('type');
                if (type == 1) {
                    // alert('Janu')
                    $('#package_checkbox').prop('checked', true);
                    // $('#package_checkbox').prop('checked');
                }

                $("#edit_name").val(name)
                $('#edit_id').val(id);
                $('#price').val(price);
                $('#duration').val(duration);
                $('#like_id').val(like);
                $('#boost_id').val(boost);
                // $('#type').val(type);

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
    </script>
@endsection
@endsection
