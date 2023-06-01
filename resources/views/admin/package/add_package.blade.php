@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">
        <form class="package">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Package Name</label>
                <input type="text"  name="package" class="form-control" placeholder="Enter Package Name ">

            </div>
            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
<script>
    $(function() {

        $('.package').on('submit', function(e) {
            e.preventDefault()

            let fd = new FormData(this)
            fd.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('admin.add.user') }}",
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
 