@extends('admin.layout.layouts')
@section('extra_css')

@endsection

@section('content')
   

    <section class="content" style="background:none;">

        <form  class="updatepas" class="mt-5">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Current Password</label>
                <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">New Password</label>
                <input type="password" class="form-control" name="n_password" placeholder="Enter New Password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">New Password Again</label>
                <input type="password" class="form-control" name="c_password" placeholder="Enter New Password Again">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
   </section>
@endsection


@section('extra_js')






<script>
    $(function() {

        // Update profile
        

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



           })
</script>



@endsection
