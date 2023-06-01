@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.css') }}" />
    @yield('styles')
@endsection

@section('content')
    <section class="content" style="background:none;">
        <form class="privacy_policy">
            @csrf
            <div class="mb-3">
                @if($getdata)
                <input type="hidden" name="id" value="{{ $getdata->id }}">
                @else
                @endif
                <label for="exampleInputEmail1" class="form-label">Title</label><br>
                @if($getdata)
                <input type="text" name="title" class="form-control" value="{{ $getdata->title }}"><br>
                @else
                <input type="text" name="title" class="form-control" ><br>
                @endif
                @if($getdata)
                <textarea name="policy" id="summernote" cols="30" rows="3">{{ $getdata->policy }}</textarea><br>
                @else
                <textarea name="policy" id="summernote" cols="30" rows="3"></textarea><br>
                @endif
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>
    </section>
@endsection

@section('extra_js')
    <script src="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
        $(function() {

            $('.privacy_policy').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.addpolicy') }}",
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
