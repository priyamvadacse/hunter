@extends('admin.layout.layouts')
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/summernote/summernote-bs4.css')}}" />


@endsection

@section('content')
    <section class="contact" style="background:none;">
        <section class="content" style="background:none;">
            <form class="faq">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="id" value="{{$edit->id}}">
                    <label for="exampleInputEmail1" class="form-label">Question</label><br>
                    <input type="text" name="question" class="form-control" value="{{$edit->question}}">
                   
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Answer</label><br>
                    <textarea name="answer" id="summernote" cols="30" rows="3">{{$edit->answer}}</textarea><br>
                   
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

                $('.faq').on('submit', function(e) {
                    e.preventDefault()

                    let fd = new FormData(this)
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{ route('admin.faqupdate') }}",
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
