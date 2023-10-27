@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.css') }}" />
@endsection

@section('content')

        <section class="content" style="background:none;">
            <div class="mb-4">
                <div class="card-header">
                  <h6>Social Media</h6>  
                </div>
            </div>
            <form class="social_media">
                @csrf
                <div class="mb-3">
                    @if (!blank($getdata))
                        <input type="hidden" name="id" value="{{ $getdata->id }}">
                    @else
                    @endif
                    @if (!blank($getdata))
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Facebook</b></label><br>
                            <input type="text" name="facebook" class="form-control" value="{{$getdata->facebook_link}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Instagram</b></label><br>
                            <input type="text" name="instagram" class="form-control" value="{{ $getdata->instagram_link }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>YouTube</b></label><br>
                            <input type="text" name="youtube" class="form-control" value="{{ $getdata->youtube_link }}">
                        </div>
                       
                    @else
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Facebook</b></label><br>
                            <input type="text" name="facebook" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Instagram</b></label><br>
                            <input type="text" name="instagram" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>YouTube</b></label><br>
                            <input type="text" name="youtube" class="form-control" >
                        </div>
                        
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

                $('.social_media').on('submit', function(e) {
                    e.preventDefault()

                    let fd = new FormData(this)
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{route('admin.social_medial_update')}}",
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
