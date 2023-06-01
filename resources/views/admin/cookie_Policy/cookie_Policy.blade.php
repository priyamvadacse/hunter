@extends('admin.layout.layouts')
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/summernote/summernote-bs4.css')}}" />


@endsection

@section('content')
    <section class="contact" style="background:none;">
        <section class="content" style="background:none;">
            <form class="cookiepolicy">
                @csrf
                <div class="mb-3">
                    @if($getdata)
                    <input type="hidden" name="id" value="{{$getdata->id}}">
                    @else
                    @endif
                    <label for="exampleInputEmail1" class="form-label">Cookie Policy</label><br>
                   @if($getdata)
                    <textarea name="cookiepolicy" id="summernote" cols="30" rows="3">{{$getdata->cookie_policy}}</textarea><br>
                    @else
                    <textarea name="cookiepolicy" id="summernote" cols="30" rows="3"></textarea><br>
                    @endif
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </section>
    @endsection

    @section('extra_js')
    <script src="{{asset('assets/admin/assets/bundles/summernote/summernote-bs4.js')}}"></script>
        <script type="text/javascript">
            $('#summernote').summernote({
                height: 400
            });
            $(function() {

                $('.cookiepolicy').on('submit', function(e) {
                    e.preventDefault()

                    let fd = new FormData(this)
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{ route('admin.cookiepolicypage') }}",
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
    </section>
@endsection

@section('extra_js')
@endsection
