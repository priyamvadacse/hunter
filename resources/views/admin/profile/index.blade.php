@extends('admin.layout.layouts')
@section('extra_css')

@endsection

@section('content')
    <section class="content" style="background:none;">



        <form class="updateprofile" enctype="multipart/form-data" method="post" >
            @csrf
            <div class="mb-3" >
                <label for="exampleInputEmail1" class="form-label">Image</label>
                <input type="file" class="form-control" name="file" >

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{Auth::guard('admin')->user()->name}}">
                <input type="hidden" class="form-control" name="id" value="{{Auth::guard('admin')->user()->id}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="Email" class="form-control" name="email" value="{{Auth::guard('admin')->user()->email}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>


        </form>





    </section>

    
@endsection


@section('extra_js')






<script>
    $(function() {

        // Update profile
        $('.updateprofile').on('submit', function(e) {
            e.preventDefault()
            let fd = new FormData(this)
            fd.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('admin.profilesubmit') }}",
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
                        }, 2000);

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

        $('.updatepas').on('submit', function(e) {
            e.preventDefault()
            let fd = new FormData(this)
            fd.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('admin.passwordreset') }}",
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
                            window.location.reload();
                        }, 2000);

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



           })
</script>



@endsection
