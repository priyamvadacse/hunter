@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.css') }}" />
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">

                    <h3 class="mb-1" style="color: #c8164e">Add Story </h3>
                </div>
            </div>
            <div class="card">
                {{-- <form class="add_user" method="POST" action="{{ route('admin.add.user') }}" enctype="multipart/form-data"> --}}
                <form class="add_story" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Story Title" name="title">
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Story Image</label>
                                <input type="file" class="form-control" name="story_image">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Story Description</label>
                                <textarea name="story_description" class="form-control" id="summernote" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </section>
@endsection
@section('extra_js')
    <script src="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 200
        })

        $(function() {
            $('.add_story').on('submit',function(e) {
                e.preventDefault();
                let fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");
                
                $.ajax({                    
                    url: "{{route('admin.save_story')}}",
                    type: "post",
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    
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
                })
            });
        });
    </script>
@endsection
