@extends('admin.layout.layouts')
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/summernote/summernote-bs4.css')}}" />


@endsection

@section('content')
    <section class="contact" style="background:none;">
        <section class="content" style="background:none;">
            <form class="aboutus">
                @csrf
                <div class="mb-3">
                    
                    {{-- <input type="hidden" name="id" value="{{$edit->id}}"> --}}
                    <label for="exampleInputEmail1" class="form-label">Title</label><br>
                    @if(!empty($getdata))
                    <input type="text" name="title" class="form-control" value="{{$getdata->title}}">
                    @else
                    <input type="text" name="title" class="form-control" >
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Content</label><br>
                    @if(!empty($getdata))
                    <textarea name="about_us" id="summernote" cols="30" rows="3">{{$getdata->content}}</textarea><br>
                    @else
                    <textarea name="about_us" id="summernote" cols="30" rows="3"></textarea><br>
                   @endif
                </div>                    

                <button type="submit" class="btn btn-primary">Update</button>

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

                $('.aboutus').on('submit', function(e) {
                    e.preventDefault()

                    let fd = new FormData(this)
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{ route('admin.about_us_update') }}",
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
