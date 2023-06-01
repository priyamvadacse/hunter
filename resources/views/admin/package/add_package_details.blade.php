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
                    Add Package Details
                </div>
            </div>
            <div class="card">
                {{-- <form class="add_user" method="POST" action="{{ route('admin.add.user') }}" enctype="multipart/form-data"> --}}
                <form class="add_details" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Package Name</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="id">
                                    @foreach ($package as $p)
                                    <option value="{{$p->id}}">{{$p->package}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Package Duration</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="duration">
                                    <option value="30">1 Month</option>
                                    <option value="180">6 Month</option>
                                    <option value="360">12 Month</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" class="form-control" placeholder="Enter Monthly Price" name="price">
                            </div>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>

    @endsection
@section('extra_js')
    <script>
        $(function() {

            $('.add_details').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.store_package.details') }}",
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
