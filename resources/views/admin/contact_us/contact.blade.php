@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.css') }}" />
@endsection

@section('content')
    
        <section class="content" style="background:none;">
            <form class="contact">
                @csrf
                <div class="mb-3">
                    @if (!blank($getdata))
                        <input type="hidden" name="id" value="{{ $getdata->id }}">
                    @else
                    @endif
                    @if (!blank($getdata))
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Phone Number</b></label><br>
                            <input type="text" name="contactPhone" class="form-control" value="{{$getdata->phone_number}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Email</b></label><br>
                            <input type="email" name="contactEmail" class="form-control" value="{{ $getdata->email }}">
                        </div>
                        <div>
                            <label for="exampleInputEmail1" class="form-label"><b>Contact US Form</b></label><br>
                            <textarea name="contact" id="summernote" cols="30" rows="2">{{ $getdata->contact }}</textarea><br>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Phone Number</b></label><br>
                            <input type="text" name="contactPhone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Email</b></label><br>
                            <input type="email" name="contactEmail" class="form-control">
                        </div>
                        <div>
                            <label for="exampleInputEmail1" class="form-label"><b>Contact US Form</b></label><br>
                            <textarea name="contact" id="summernote" cols="30" rows="2"></textarea><br>
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

                $('.contact').on('submit', function(e) {
                    e.preventDefault()

                    let fd = new FormData(this)
                    fd.append('_token', "{{ csrf_token() }}");
                    $.ajax({
                        url: "{{ route('admin.contactus') }}",
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
